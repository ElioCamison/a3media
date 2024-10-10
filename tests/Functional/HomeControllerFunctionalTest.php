<?php

namespace Tests\Functional;

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\ServerRequestFactory;
use DI\Container;
use Controllers\HomeController;
use Repositories\ProgramacionRepository;

class HomeControllerFunctionalTest extends TestCase {
    protected $app;

    protected function setUp(): void {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../', '.env.testing');
        $dotenv->load();
    
        parent::setUp();
    
        $container = new Container();
    
        $dependencies = require __DIR__ . '/../../src/config/dependencies.php';
        $dependencies($container);
    
        AppFactory::setContainer($container);
        $this->app = AppFactory::create();
    
        $this->app->get('/programaciones', \Controllers\HomeController::class . ':getAll');
        $this->app->get('/programacion/{id}', \Controllers\HomeController::class . ':getProgramacionById');
        $this->app->post('/programacion', \Controllers\HomeController::class . ':addProgramacion');
        $this->app->put('/programacion/{id}', \Controllers\HomeController::class . ':updateProgramacion');
        $this->app->delete('/programacion/{id}', \Controllers\HomeController::class . ':deleteProgramacion');
    }
    
    public function testGetAll() {
        $mockRepo = $this->createMock(ProgramacionRepository::class);
        $mockRepo->method('getAll')->willReturn([
            ['id' => 1, 'nombre' => 'Programación 1'],
            ['id' => 2, 'nombre' => 'Programación 2']
        ]);
        $this->app->getContainer()->set(ProgramacionRepository::class, $mockRepo);
    
        $request = (new ServerRequestFactory())->createServerRequest('GET', '/programaciones');
        $response = $this->app->handle($request);
    
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson((string)$response->getBody());
    
        $data = json_decode((string)$response->getBody(), true);
        $this->assertNotEmpty($data);
    }
    
    public function testGetProgramacionByIdFound() {
        $mockRepo = $this->createMock(ProgramacionRepository::class);
        $mockRepo->method('findById')->willReturn(['id' => 1, 'nombre' => 'Programación 1']);
        $this->app->getContainer()->set(ProgramacionRepository::class, $mockRepo);
    
        $request = (new ServerRequestFactory())->createServerRequest('GET', '/programacion/1');
        $response = $this->app->handle($request);
    
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson((string)$response->getBody());
    
        $data = json_decode((string)$response->getBody(), true);
        $this->assertEquals(1, $data['id']);
        $this->assertEquals('Programación 1', $data['nombre']);
    }
    
    public function testGetProgramacionByIdNotFound() {
        // Mockear el repositorio para devolver null, simulando un registro no encontrado
        $mockRepo = $this->createMock(ProgramacionRepository::class);
        $mockRepo->method('findById')->willReturn(null);
        $this->app->getContainer()->set(ProgramacionRepository::class, $mockRepo);
    
        // Crear la solicitud
        $request = (new ServerRequestFactory())->createServerRequest('GET', '/programacion/999');
        $response = $this->app->handle($request);
    
        // Verificar la respuesta
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertJson((string)$response->getBody());
    
        $data = json_decode((string)$response->getBody(), true);
        $this->assertArrayHasKey('error', $data);
    }
    
    public function testAddProgramacion() {
        $mockRepo = $this->createMock(ProgramacionRepository::class);
        $mockRepo->method('create')->willReturn(true);
        $this->app->getContainer()->set(ProgramacionRepository::class, $mockRepo);

        $request = (new ServerRequestFactory())->createServerRequest('POST', '/programacion')
                   ->withHeader('Content-Type', 'application/json')
                   ->withParsedBody(['nombre' => 'Nueva Programación']);
        $response = $this->app->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson((string)$response->getBody());
    
        $data = json_decode((string)$response->getBody(), true);
        $this->assertArrayHasKey('message', $data);
    }
    
    public function testUpdateProgramacion() {
        $mockRepo = $this->createMock(ProgramacionRepository::class);
        $mockRepo->method('update')->willReturn(true);
        $this->app->getContainer()->set(ProgramacionRepository::class, $mockRepo);

        $request = (new ServerRequestFactory())->createServerRequest('PUT', '/programacion/1')
                   ->withHeader('Content-Type', 'application/json')
                   ->withParsedBody(['nombre' => 'Programación Actualizada']);
        $response = $this->app->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson((string)$response->getBody());
    
        $data = json_decode((string)$response->getBody(), true);
        $this->assertArrayHasKey('message', $data);
    }
    
    public function testDeleteProgramacion() {
        $mockRepo = $this->createMock(ProgramacionRepository::class);
        $mockRepo->method('delete')->willReturn(true);
        $this->app->getContainer()->set(ProgramacionRepository::class, $mockRepo);

        $request = (new ServerRequestFactory())->createServerRequest('DELETE', '/programacion/1');
        $response = $this->app->handle($request);

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertEmpty((string)$response->getBody());
    }
    
}
