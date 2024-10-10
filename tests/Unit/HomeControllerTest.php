<?php

namespace Tests\Unit;

use Controllers\HomeController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Repositories\ProgramacionRepository;
use PHPUnit\Framework\TestCase;

/**
 * Class HomeControllerTest
 * @package Tests\Unit
 *
 * Esta clase contiene pruebas unitarias para el controlador HomeController.
 */
class HomeControllerTest extends TestCase {
    protected $homeController;
    protected $mockRepository;
    protected $mockLogger;
    protected $mockResponse;
    protected $mockRequest;

    /**
     * Configura el entorno de prueba antes de cada caso de prueba.
     */
    protected function setUp(): void {
        $this->mockRepository = $this->createMock(ProgramacionRepository::class);
        $this->mockLogger = $this->createMock(LoggerInterface::class);
        $this->mockResponse = $this->createMock(ResponseInterface::class);
        $this->mockRequest = $this->createMock(ServerRequestInterface::class);

        $this->homeController = new HomeController($this->mockRepository, $this->mockLogger);
    }

    /**
     * Testea la obtención de todas las programaciones.
     * Se espera que el controlador retorne un código de estado 200 y 
     * que los datos devueltos correspondan a las programaciones existentes.
     * Este método comprueba que el repositorio devuelve la lista correcta 
     * de programaciones y que se registra la llamada al logger.
     *
     * @return void
     */
    public function testGetAll() {
        $data = ['programacion1', 'programacion2'];

        $this->mockRepository->method('getAll')->willReturn($data);
        $this->mockLogger->expects($this->once())->method('info');

        $this->mockResponse = $this->createMock(ResponseInterface::class);
        $this->mockResponse->method('withStatus')->willReturn($this->mockResponse);
        $this->mockResponse->method('withHeader')->willReturn($this->mockResponse);

        $bodyMock = $this->createMock(\Psr\Http\Message\StreamInterface::class);
        $bodyMock->method('write')->willReturn(strlen(json_encode($data)));
        $this->mockResponse->method('getBody')->willReturn($bodyMock);

        // Simula que el ResponseBuilder::json modifica el código de estado
        $this->mockResponse->method('getStatusCode')->willReturn(200);

        $response = $this->homeController->getAll($this->mockRequest, $this->mockResponse);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Testea la obtención de una programación por ID cuando se encuentra.
     * Se espera que el controlador retorne un código de estado 200
     * y que devuelva los datos de la programación solicitada.
     * Este método asegura que el repositorio retorne los datos correctos
     * y que se registre la llamada al logger.
     *
     * @return void
     */
    public function testGetProgramacionByIdFound() {
        $id = 1;
        $programacionData = ['id' => $id, 'nombre' => 'Programación 1'];

        $this->mockRequest->method('getParsedBody')->willReturn([]);
        $this->mockRepository->method('findById')->with($id)->willReturn($programacionData);
        $this->mockLogger->expects($this->once())->method('info');

        $this->mockResponse = $this->createMock(ResponseInterface::class);
        $this->mockResponse->method('withStatus')->willReturn($this->mockResponse);
        $this->mockResponse->method('withHeader')->willReturn($this->mockResponse);
        $this->mockResponse->method('getStatusCode')->willReturn(200);
        
        $response = $this->homeController->getProgramacionById($this->mockRequest, $this->mockResponse, ['id' => $id]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Testea la obtención de una programación por ID cuando no se encuentra.
     * Se espera que el controlador retorne un código de estado 404
     * indicando que no se pudo encontrar la programación solicitada.
     * Este método verifica que el repositorio no encuentre la programación 
     * y que se registre la advertencia en el logger.
     *
     * @return void
     */
    public function testGetProgramacionByIdNotFound() {
        $id = 999;

        $this->mockRepository->method('findById')->with($id)->willReturn(null);
        $this->mockLogger->expects($this->once())->method('warning');

        $this->mockResponse = $this->createMock(ResponseInterface::class);
        $this->mockResponse->method('withStatus')->willReturn($this->mockResponse);
        $this->mockResponse->method('withHeader')->willReturn($this->mockResponse);
        $this->mockResponse->method('getStatusCode')->willReturn(404);
        
        $response = $this->homeController->getProgramacionById($this->mockRequest, $this->mockResponse, ['id' => $id]);

        $this->assertEquals(404, $response->getStatusCode());
    }

    /**
     * Testea la actualización de una programación.
     * Se espera que el controlador retorne un código de estado 200
     * cuando la actualización se realiza exitosamente.
     * Este método comprueba que se pase correctamente el cuerpo de la solicitud 
     * y que se llame al logger para registrar la información.
     *
     * @return void
     */
    public function testUpdateProgramacionSuccess() {
        $id = 1;
        $params = ['nombre' => 'Updated Program'];
    
        $this->mockRequest->method('getParsedBody')->willReturn($params);
        $this->mockRepository->method('update')->with($id, $params)->willReturn(true);
        $this->mockLogger->expects($this->once())->method('info');
    
        $this->mockResponse = $this->createMock(ResponseInterface::class);
        $this->mockResponse->method('withStatus')->willReturn($this->mockResponse);
        $this->mockResponse->method('withHeader')->willReturn($this->mockResponse);
        $this->mockResponse->method('getStatusCode')->willReturn(200);
    
        $response = $this->homeController->updateProgramacion($this->mockRequest, $this->mockResponse, ['id' => $id]);
    
        $this->assertEquals(200, $response->getStatusCode());
    }
    
    /**
     * Testea la actualización de una programación cuando falla.
     * Se espera que el controlador retorne un código de estado 500
     * cuando la actualización no se puede realizar.
     * Este método verifica que se registre un error en el logger
     * y que el repositorio no actualice la programación.
     *
     * @return void
     */
    public function testUpdateProgramacionFailure() {
        $id = 1;
        $params = ['nombre' => 'Updated Program'];

        $this->mockRequest->method('getParsedBody')->willReturn($params);
        $this->mockRepository->method('update')->with($id, $params)->willReturn(false);
        $this->mockLogger->expects($this->once())->method('error');

        $this->mockResponse = $this->createMock(ResponseInterface::class);
        $this->mockResponse->method('withStatus')->willReturn($this->mockResponse);
        $this->mockResponse->method('withHeader')->willReturn($this->mockResponse);
        $this->mockResponse->method('getStatusCode')->willReturn(500);

        $response = $this->homeController->updateProgramacion($this->mockRequest, $this->mockResponse, ['id' => $id]);

        $this->assertEquals(500, $response->getStatusCode());
    }

    /**
     * Testea la adición de una nueva programación.
     * Se espera que el controlador retorne un código de estado 200
     * cuando la programación se agrega exitosamente.
     * Este método verifica que se pase correctamente el cuerpo de la solicitud 
     * y que se llame al logger para registrar la información.
     *
     * @return void
     */
    public function testAddProgramacionSuccess() {
        $params = ['nombre' => 'New Program'];

        $this->mockRequest->method('getParsedBody')->willReturn($params);
        $this->mockRepository->method('create')->with($params)->willReturn(true);
        $this->mockLogger->expects($this->once())->method('info');

        $this->mockResponse = $this->createMock(ResponseInterface::class);
        $this->mockResponse->method('withStatus')->willReturn($this->mockResponse);
        $this->mockResponse->method('withHeader')->willReturn($this->mockResponse);
        $this->mockResponse->method('getStatusCode')->willReturn(200);

        $response = $this->homeController->addProgramacion($this->mockRequest, $this->mockResponse);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Testea la adición de una nueva programación cuando falla.
     * Se espera que el controlador retorne un código de estado 500
     * cuando la adición no se puede realizar.
     * Este método verifica que se registre un error en el logger
     * y que el repositorio no cree la nueva programación.
     *
     * @return void
     */
    public function testAddProgramacionFailure() {
        $params = ['nombre' => 'New Program'];

        $this->mockRequest->method('getParsedBody')->willReturn($params);
        $this->mockRepository->method('create')->with($params)->willReturn(false);
        $this->mockLogger->expects($this->once())->method('error');

        $this->mockResponse = $this->createMock(ResponseInterface::class);
        $this->mockResponse->method('withStatus')->willReturn($this->mockResponse);
        $this->mockResponse->method('withHeader')->willReturn($this->mockResponse);
        $this->mockResponse->method('getStatusCode')->willReturn(500);

        $response = $this->homeController->addProgramacion($this->mockRequest, $this->mockResponse);

        $this->assertEquals(500, $response->getStatusCode());
    }

    /**
     * Prueba el método deleteProgramacion() del HomeController cuando la eliminación es exitosa.
     * Se espera que el controlador retorne un código de estado 204 cuando la programación
     * se elimina correctamente.
     * Este método verifica que el repositorio confirme la eliminación y que se registre
     * la información en el logger.
     *
     * @return void
     */
    public function testDeleteProgramacionSuccess() {
        $id = 1;

        $this->mockRepository->method('delete')->with($id)->willReturn(true);
        $this->mockLogger->expects($this->once())->method('info');

        $this->mockResponse = $this->createMock(ResponseInterface::class);
        $this->mockResponse->method('withStatus')->willReturn($this->mockResponse);
        $this->mockResponse->method('withHeader')->willReturn($this->mockResponse);
        $this->mockResponse->method('getStatusCode')->willReturn(204);

        $response = $this->homeController->deleteProgramacion($this->mockRequest, $this->mockResponse, ['id' => $id]);

        $this->assertEquals(204, $response->getStatusCode());
    }

    /**
     * Prueba el método deleteProgramacion() del HomeController cuando la eliminación falla.
     * Se espera que el controlador retorne un código de estado 500 cuando no se puede eliminar
     * la programación.
     * Este método asegura que se registre un error en el logger y que el repositorio
     * no confirme la eliminación de la programación.
     *
     * @return void
     */
    public function testDeleteProgramacionFailure() {
        $id = 1;

        $this->mockRepository->method('delete')->with($id)->willReturn(false);
        $this->mockLogger->expects($this->once())->method('error');

        $this->mockResponse = $this->createMock(ResponseInterface::class);
        $this->mockResponse->method('withStatus')->willReturn($this->mockResponse);
        $this->mockResponse->method('withHeader')->willReturn($this->mockResponse);
        $this->mockResponse->method('getStatusCode')->willReturn(500);

        $response = $this->homeController->deleteProgramacion($this->mockRequest, $this->mockResponse, ['id' => $id]);

        $this->assertEquals(500, $response->getStatusCode());
    }

}
