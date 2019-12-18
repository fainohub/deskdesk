<p align="center"><img src="https://raw.githubusercontent.com/fainohub/deskdesk/master/public/images/deskdesk-black.png" width="400"></p>

# DeskDesk

A proposta para esse projeto foi o desenvolvimento de um sistema simples de atendimento ao cliente. Basicamente o sistema possui duas áreas, uma do cliente e outra do atendente. O cliente pode enviar tickets sobre assuntos diversos que são respondidos por agentes do sistema.
Quando um novo ticket é criado o sistema aloca esse ticket automaticamente para um agente disponível, seguindo algumas regras implementadas. O cliente consegue acompanhar os tickets enviados e conversar com o agente do atendimento através de mensagens dentro de cada ticket.
O agente de atendimento por sua vez tem acesso à uma dashboard onde ele consegue acompanhar todos os tickets atrelados a ele e dar andamento ao atendimento. Quando um atendimento é finalizado o agente marca o ticket como finalizado, dando encerramento naquele atendimento.
Assim nasce o DeskDesk, um simples sistema help desk em PHP para o processo seletivo da MadeiraMadeira.

## Diagrama de Entidade Relacionamento
A modelagem do banco de dados ficou extremamente simples, contendo apenas as tabelas de agentes, clientes e tickets. Vale ressaltar o uso do polimorfismo na tabela de ticket_messages, onde a mensagem em um ticket pode ser enviada por um cliente ou um agente.


## Diagrama de Casos de Uso
O sistema consiste em 5 casos de usos básicos: realizar cadastro, criar ticket, responder ticket, fechar ticket e atribuir ticket. Dentro desse cenário encontram-se 3 atores: o cliente, o agente e o sistema. O cliente pode realizar o cadastro de sua conta com seu login e senha, pode criar um ticket e além disso adicionar respostas/mensagens em um ticket criado. O ator, por sua vez, responde os tickets atribuídos a ele e quando encerra o atendimento ele pode fechar um ticket. Nesse fluxo o sistema tem o papel apenas de atribuir um novo ticket a um agente de atendimento.


## Tecnologias
O projeto foi desenvolvido utilizando o framework Laravel na versão 6 e o PHP na versão 7.2. Para o frontend foi utilizado um web template gratuito encontrado na internet (Connect Plus), instalado no projeto criando os layouts dentro da template engine do Laravel, a Blade Template. Para persistência dos dados foi utilizado o banco de dados MySQL. Como serviço de Log foi utilizado o Loggly que é um provedor de serviços de análise e gerenciamento de logs baseado em nuvem.


## Arquitetura
Como requisito do projeto foi utilizado uma arquitetura MVC com uma camada de serviço. Além disso foi adicionado uma camada de repositório para persistência e consulta dos dados, deixando a camada de serviço somente com a responsabilidade das regras de negócio.
Nas camadas de serviço e repositório o intuito foi deixar frameworkless, o mais independente de framework possível, por isso a grande utilização de contratos e inversão de dependência, o que deixa o código dependente apenas da abstração e não da implementação, conseguindo ficar desacoplado do framework.
Para a camada de repositório, como foi utilizado o framework Laravel, a implementação foi feita utilizando o Eloquent. Mas através dos contratos poderia ser facilmente implementado utilizando outro ORM como o Doctrine, por exemplo.


## Design Patterns

#### Singleton
O design pattern Singleton foi utilizado em um Helper para criação do contexto a ser enviado ao serviço de log, abaixo segue sua implementação.

```
<?php

declare(strict_types=1);

namespace App\Helpers;

use Exception;

final class LogContext
{
   private static $instance;

   public static function getInstance(): LogContext
   {
       if (static::$instance === null) {
           static::$instance = new static();
       }

       return static::$instance;
   }

    private function __construct()
    {
        //prevent from creating multiple instances
    }

    private function __clone()
    {
        //prevent the instance from being cloned
    }

    private function __wakeup()
    {
        //prevent from being unserialized
    }

   public static function context(Exception $exception = null): array
   {
       return self::getInstance()->getContext($exception);
   }

   public function getContext(Exception $exception = null): array
   {
       $context = array();

       $context['user'] = [
           'id'     => auth()->user() ? auth()->user()->id : null,
           'name'   => auth()->user() ? auth()->user()->name : null,
           'email'  => auth()->user() ? auth()->user()->emaul : null,
           'origin' => request()->headers->get('origin') ?? null,
           'ip'     => request()->server('REMOTE_ADDR') ?? null,
           'agent'  => request()->server('HTTP_USER_AGENT') ?? null
       ];

       if ($exception) {
           $context['exception'] = [
               'message' => $exception->getMessage(),
               'file'    => $exception->getFile(),
               'line'    => $exception->getLine(),
               'code'    => $exception->getCode(),
               'trace'   => $exception->getTraceAsString()
           ];
       }

       return $context;
   }
}
```

#### Factory
O design pattern Factory foi utilizado para criação de uma classe de serviço que possuía uma regra de negócio para sua criação dependendo da configuração do sistema. Abaixo segue a sua interface e implementação.

*App\Services\Contracts\FindAgentFactoryInterface.php*
```
<?php

declare(strict_types=1);

namespace App\Services\Contracts;

interface FindAgentFactoryInterface
{
   public function create(): FindAgentServiceInterface;
}
```
*App\Services\FindAgentServiceFactory.php*
```
<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Contracts\FindAgentFactoryInterface;
use App\Services\Contracts\FindAgentServiceInterface;
use App\Repositories\Contracts\AgentRepositoryInterface;

class FindAgentServiceFactory implements FindAgentFactoryInterface
{
   private $agentRepository;

   public function __construct()
   {
       $this->agentRepository = resolve(AgentRepositoryInterface::class);
   }

   public function create(): FindAgentServiceInterface
   {
       $method = config('agents.allocate.method');
       $classes = config('agents.allocate.classes');

       $class = $classes[$method];

       return new FindAgentService(new $class($this->agentRepository));
   }
}
```

#### Strategy Pattern
O design pattern Strategy foi utilizado para o serviço de alocação de tickets para um agente de atendimento, onde poderiam ter N algoritmos para escolha do melhor agente para aquele ticket (primeiro, randômico, fila, etc...). Para exemplificação desse pattern foi implementado 3 simples algoritmos para escolha do agente: encontrar o primeiro agente (FindAgentFirst), o último agente (FindAgentLast) ou randômico (FindAgentRandom).

Desse modo o serviço FindAgentService terá outputs diferentes baseado nas classes passadas em seu construtor. A escolha do algoritmo utilizado é configurado através de uma variável de ambiente no .env da aplicação (ALLOCATE_AGENT_METHOD), que pode ter valores first, last ou random. O design pattern factory mostrado acima é justamente para instanciar um novo serviço FindAgentService baseado na configuração do sistema, usando o pattern strategy. Abaixo seguem alguns exemplos desse pattern:

```
//Obter um agente seguindo a regra do primeiro agente:
$findService = new FindAgentService(new FindAgentFirst($agentRepository));
$agent = findService->find();

//Obter um agente seguindo a regra do último agente:
$findService = new FindAgentService(new FindAgentLast($agentRepository));
$agent = findService->find();

//Obter um agente seguindo a regra randômica:
$findService = new FindAgentService(new FindAgentRandom($agentRepository));
$agent = findService->find();
```

#### Filter Pattern
O Filter Pattern foi aplicado na camada de repositório, criando uma classe abstrata Criteria, onde cada filtro deverá estendê-la para ser adicionado no repositório a ser aplicado o filtro.

Abaixo segue um exemplos de código utilizando o filter pattern na camada de repositório para obter os tickers de um cliente, ordenados de forma crescente pela data de atualização e retornar o resultado paginado. As classes ByCustomert e LatestByDate são filtros que estendem da classe Criteria e implementam a função apply.

```
class TicketRepository extends Repository implements TicketRepositoryInterface
{
   public function ticketsPaginatedByCustomer(Customer $customer)
   {
       $this->pushCriteria(new ByCustomer($customer));
       $this->pushCriteria(new LatestByDate('updated_at'));

       return $this->paginate();
   }
}

class LatestByDate extends Criteria
{
   private $attribute;

   public function __construct(string $attribute = 'updated_at')
   {
       $this->attribute = $attribute;
   }

   public function apply($model, RepositoryInterface $repository)
   {
       $model = $model->latest($this->attribute);

       return $model;
   }
}

class ByCustomer extends Criteria
{
   private $customer;

   public function __construct(Customer $customer)
   {
       $this->customer = $customer;
   }

   public function apply($model, RepositoryInterface $repository)
   {
       $model = $model->where('customer_id', '=', $this->customer->id);

       return $model;
   }
}
```

## Test Driven Development

No desenvolvimento do projeto foi seguido alguns conceitos do TDD (Test Driven Development). Foram escritos testes de Feature para os casos de uso e testes de unidade para cada função de cada classe desenvolvida.
Devido ao tempo do projeto os testes desenvolvidos foram os mais básicos possíveis e tiveram o intuito de auxiliar o desenvolvimento do projeto com a melhor qualidade e mostrar a importância do desenvolvimento seguindo esse modelo.

## Melhorias Futuras e Escalabilidade
Como melhorias futuras no projeto pode se destacar o desenvolvimento de um FAQ e uma base de conhecimento, com assuntos mais buscados pelos clientes, para que esses clientes consigam solucionar suas dúvidas ou problemas sem precisar entrar em contato com a equipe de atendimento.
Olhando para o lado da escalabilidade é possível notar que, com milhares de clientes, qualquer sistema básico de atendimento que temos hoje (telefone, email, chat, tickets...) não são escaláveis e demandaria muito esforço humano para um atendimento eficaz e de qualidade. Analisando por esse ponto uma proposta que atenderia parte dessa escalabilidade seria um chatbot, criar um robô de atendimento para quando nenhum atendente humano estiver disponível ou até mesmo evoluir essa inteligência artificial para que todos os atendimentos sejam feitos através de robôs.
Para implementação dentro desse projeto, pensando em seguir a mesma linha do desenvolvimento em PHP e de forma simplificada, foi avaliado a implementação do [BotMan](https://botman.io/), que é uma biblioteca PHP para o desenvolvimento de chatbot. Devido ao tempo do projeto infelizmente essa proposta não pode ser implementada, mas fica como proposta de melhoria futura.
