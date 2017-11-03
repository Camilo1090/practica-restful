<?php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Actor;
class ActorController extends FOSRestController
{

    /**
     * @Rest\Get("/actores")
     */
    public function actoresAction(Request $request)
    {
        // entity manager
        $em = $this->getDoctrine()->getManager();

        // repo películas
        $repoActores = $em->getRepository('AppBundle:Actor');
        $output = array();

        $actores = $repoActores->findAll();

        if ($actores) {
            foreach($actores as $actor) {

                //peliculas
                $peliculas = array();
                foreach ($actor->getPeliculas() as $pelicula) {
                    $peliculas[] = array(
                        'id'             => $pelicula->getId(),
                        'nombre'         => $pelicula->getNombre(),
                        'resumen'        => $pelicula->getResumen(),
                        'url_trailer'    => $pelicula->getUrlTrailer()
                    );
                }

                //pais
                if ($actor->getPais()) {
                    $pais = $actor->getPais()->getNombre();
                } else {
                    $pais = null;
                }

                //actores
                $output[] = array(
                    'id'             => $actor->getId(),
                    'nombre'         => $actor->getNombre(),
                    'ano_nacimiento' => $actor->getAnoNacimiento(),
                    'pais'           => $pais,
                    'peliculas'      => $peliculas
                );
            }
            return new View($output, Response::HTTP_OK);
        } else {
            return new View('No existen actores aun.', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Rest\Get("/actores/{id}")
     */
    public function actorAction(Request $request, $id)
    {
        // entity manager
        $em = $this->getDoctrine()->getManager();

        // repo películas
        $repoActores = $em->getRepository('AppBundle:Actor');
        $output = array();

        // busca la película
        $actor = $repoActores->find($id);

        if ($actor) {

            //peliculas
            $peliculas = array();
            foreach ($actor->getPeliculas() as $pelicula) {
                $peliculas[] = array(
                    'id'             => $pelicula->getId(),
                    'nombre'         => $pelicula->getNombre(),
                    'resumen'        => $pelicula->getResumen(),
                    'url_trailer'    => $pelicula->getUrlTrailer()
                );
            }

            //pais
            if ($actor->getPais()) {
                $pais = $actor->getPais()->getNombre();
            } else {
                $pais = null;
            }

            //actores
            $output[] = array(
                'id'             => $actor->getId(),
                'nombre'         => $actor->getNombre(),
                'ano_nacimiento' => $actor->getAnoNacimiento(),
                'pais'           => $pais,
                'peliculas'      => $peliculas,
            );

            return new View($output, Response::HTTP_OK);
        } else {
            return new View('Actor no encontrado', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Rest\Post("/actores")
     */
    public function postActorAction(Request $request)
    {
        // entity manager
        $em = $this->getDoctrine()->getManager();

        //parametros de la petición
        $nombre = $request->request->get('nombre');
        $ano_nacimiento = $request->request->get('ano_nacimiento');

        // entidad
        $actor = new Actor();
        $actor->setNombre($nombre);
        $actor->setAnoNacimiento($ano_nacimiento);

        // persistencia
        try {
            $em->persist($actor);
            $em->flush();
            return new View('Creación satisfactoria.', Response::HTTP_CREATED);
        } catch (exception $e) {
            return new View('Se presentó un error.', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Rest\Put("/actores/{id}")
     */
    public function putActorAction(Request $request, $id)
    {
        // entity manager y repo
        $em = $this->getDoctrine()->getManager();
        $repoActores = $em->getRepository('AppBundle:Actor');

        //parametros de la petición
        $nombre = $request->request->get('nombre');
        $ano_nacimiento = $request->request->get('ano_nacimiento');

        // entidad
        $actor = $repoActores->find($id);
        $actor->setNombre($nombre);
        $actor->setAnoNacimiento($ano_nacimiento);

        // persistencia
        try {
            $em->persist($actor);
            $em->flush();
            return new View('Actualizacion satisfactoria.', Response::HTTP_CREATED);
        } catch (exception $e) {
            return new View('Se presentó un error.', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Rest\Delete("/actores/{id}")
     */
    public function deleteActorAction(Request $request, $id)
    {
        // entity manager
        $em = $this->getDoctrine()->getManager();

        //repo  y entidad actores
        $repoActores = $em->getRepository('AppBundle:Actor');
        $actor = $repoActores->find($id);

        if ($actor) {
            // eliminacion
            $em->remove($actor);
            $em->flush();
            return new View("Eliminación satisfactoria", Response::HTTP_OK);
        } else {
            return new View('Película no encontrada', Response::HTTP_NOT_FOUND);
        }
    }
}