<?php
namespace App\Controller;

use App\Entity\Proveedor;
use App\Form\ProveedorFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;


class ProveedorController extends AbstractController



{
/**
 * @Route("proveedor_form/inicio", name="app_proveedor_inicio")
 */
public function inicio(): Response
{
    return $this->render('inicio.html.twig');

}
	 
    /**
     * @Route("proveedor_form/listado", name="app_proveedor_listado")
     */
    public function listado(): Response
    {
        $proveedores = $this->getDoctrine()->getRepository(Proveedor::class)->findAll();
        return $this->render('proveedores/listado.html.twig', [
            'proveedores' => $proveedores,
        ]);
    }
	
	

    /**
     * @Route("proveedor_form/crear", name="app_proveedor_crear")
     */

public function crear(Request $request): Response
{
    $proveedor = new Proveedor();
    $proveedor->setFechaCreacion(new \DateTime()); // Utiliza \DateTime sin importar

    $form = $this->createForm(ProveedorFormType::class, $proveedor);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($proveedor);
        $entityManager->flush();

        return $this->redirectToRoute('app_proveedor_listado');
    }

    return $this->render('proveedores/crear.html.twig', [
        'form' => $form->createView(),
    ]);
}

/**
 * @Route("proveedor_form/editar/{id}", name="app_proveedor_editar")
 */
public function editar(Request $request, $id): Response
{
    // Obtiene el repositorio de proveedores
    $repositorio = $this->getDoctrine()->getRepository(Proveedor::class);

    // Busca el proveedor por su ID
    $proveedor = $repositorio->find($id);

    // Verifica si el proveedor existe
    if (!$proveedor) {
        throw $this->createNotFoundException('Proveedor no encontrado');
    }

    // Crea el formulario con los datos del proveedor
    $form = $this->createForm(ProveedorFormType::class, $proveedor);

    // Maneja la solicitud del formulario
    $form->handleRequest($request);

    // Verifica si el formulario ha sido enviado y es válido
    if ($form->isSubmitted() && $form->isValid()) {
        // Obtiene el EntityManager
        $entityManager = $this->getDoctrine()->getManager();

        // Persiste los cambios en la base de datos
        $entityManager->flush();

        // Redirige después de guardar los cambios
        return $this->redirectToRoute('app_proveedor_listado');
    }

    // Renderiza la plantilla de edición con el formulario y los datos del proveedor
    return $this->render('proveedores/editar.html.twig', [
        'form' => $form->createView(),
        'proveedor' => $proveedor,
		 'id' => $id, // Pasar el ID del proveedor a la plantilla Twig
    ]);
}
  /**
 * @Route("proveedor_form/eliminar/{id}", name="app_proveedor_eliminar")
 */
public function eliminar($id): Response
{
    // Obtiene el EntityManager
    $entityManager = $this->getDoctrine()->getManager();

    // Obtiene el repositorio de proveedores
    $repositorio = $entityManager->getRepository(Proveedor::class);

    // Busca el proveedor por su ID
    $proveedor = $repositorio->find($id);

    // Verifica si el proveedor existe
    if (!$proveedor) {
        throw $this->createNotFoundException('Proveedor no encontrado');
    }

    // Elimina el proveedor
    $entityManager->remove($proveedor);
    $entityManager->flush();

    // Redirige después de eliminar el proveedor
    return $this->redirectToRoute('app_proveedor_listado');
}
}