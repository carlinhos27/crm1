<?php
class ClientesController extends Controller
{
    public function index()
    {
        $clienteModel = new Cliente();
        $clientes = $clienteModel->getAllClientes();

        $title = "Lista de Clientes";

        ob_start();
        view("clientes/index", ["clientes" => $clientes]);
        $content = ob_get_clean();

        view("layouts/layout", compact("title", "content"));
    }

    public function create()
    {
        $operadorModel = new User();
        $empresaModel = new Empresa();

        $operadores = $operadorModel->all();
        $empresas = $empresaModel->all();

        $title = "Crear Cliente";

        ob_start();
        view("clientes/crear", compact("operadores", "empresas"));
        $content = ob_get_clean();

        view("layouts/layout", compact("title", "content"));
    }

    public function editar($id)
    {
        $clienteModel = new Cliente();
        $operadorModel = new User();
        $empresaModel = new Empresa();

        $cliente = $clienteModel->find($id);
        $operadores = $operadorModel->all();
        $empresas = $empresaModel->all();

        if (!$cliente) {
            die("Cliente no encontrado");
        }

        $title = "Editar Cliente";

        ob_start();
        view("clientes/crear", compact("cliente", "operadores", "empresas"));
        $content = ob_get_clean();

        view("layouts/layout", compact("title", "content"));
    }

    public function update($id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $clienteModel = new Cliente();
            $clienteModel->update($id, $_POST);
            header("Location: /clientes");
            exit;
        }
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $clienteModel = new Cliente();
            $clienteModel->insert($_POST);
            header("Location: /clientes");
            exit;
        }
    }

    public function destroy($id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" || $_SERVER["REQUEST_METHOD"] === "DELETE") {
            $clienteModel = new Cliente();
            $deleted = $clienteModel->delete($id);

            if ($deleted) {
                header("Location: /clientes?success=Cliente eliminado");
                exit;
            } else {
                header("Location: /clientes?error=No se pudo eliminar el cliente");
                exit;
            }
        }
    }
}
