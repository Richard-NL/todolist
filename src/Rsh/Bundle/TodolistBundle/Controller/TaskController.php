<?php

namespace Rsh\Bundle\TodolistBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Rsh\Bundle\TodolistBundle\Entity\Task;
use Rsh\Bundle\TodolistBundle\Form\TaskType;

/**
 * Task controller.
 *
 */
class TaskController extends Controller
{

    /**
     * Lists all Task entities.
     *
     */
    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $dql   = "
        SELECT t, s, p
            FROM Rsh\Bundle\TodolistBundle\Entity\Task t
            LEFT JOIN t.status s
            LEFT JOIN t.priority p";

        $query = $entityManager->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1),
            5
        );
        return $this->render('RshTodolistBundle:Task:list.html.twig', array('pagination' => $pagination));
    }
    /**
     * Creates a new Task entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Task();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entity);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('task', array('id' => $entity->getId())));
        }

        return $this->render('RshTodolistBundle:Task:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Task entity.
     *
     * @param Task $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Task $entity)
    {
        $form = $this->createForm(new TaskType(), $entity, array(
            'action' => $this->generateUrl('task_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Task entity.
     *
     */
    public function newAction()
    {
        $entity = new Task();
        $form   = $this->createCreateForm($entity);

        return $this->render('RshTodolistBundle:Task:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Task entity.
     *
     */
    public function showAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entity = $entityManager->getRepository('RshTodolistBundle:Task')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Task entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RshTodolistBundle:Task:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Task entity.
     *
     */
    public function editAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entity = $entityManager->getRepository('RshTodolistBundle:Task')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Task entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('RshTodolistBundle:Task:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Task entity.
    *
    * @param Task $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Task $entity)
    {
        $form = $this->createForm(new TaskType(), $entity, array(
            'action' => $this->generateUrl('task_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Task entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entity = $entityManager->getRepository('RshTodolistBundle:Task')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Task entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entityManager->flush();

            return $this->redirect($this->generateUrl('task', array('id' => $id)));
        }

        return $this->render('RshTodolistBundle:Task:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Task entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entity = $entityManager->getRepository('RshTodolistBundle:Task')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Task entity.');
            }

            $entityManager->remove($entity);
            $entityManager->flush();
        }

        return $this->redirect($this->generateUrl('task'));
    }

    /**
     * Creates a form to delete a Task entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('task_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}
