<?php

namespace Wojtek\OrderBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Wojtek\OrderBundle\Entity\Post;
use Wojtek\OrderBundle\Form\PostType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

/**
 * Post controller.
 *
 */
class PostController extends Controller {

    /**
     * Lists all Post entities.
     *
     */
    public function indexAction(Request $request) {

        $data = $request->query->get('form');

        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if (empty($value)) {
                    unset($data[$key]);
                }
                unset($data['_token']);
            }

            //$data['datePayment'] = $data['datePayment'];
            //$data['dateOrder'] = date("Y-m-d", strtotime($data['dateOrder']));
        }

        $em = $this->getDoctrine()->getManager();

        if (empty($data)) {
            $entities = $em->getRepository('WojtekOrderBundle:Post')->findAll();
        } else {
            $entities = $em->getRepository('WojtekOrderBundle:Post')->findBy(
                    $data
            );
        }


        if (!isset($data['userLogin'])) {
            $data['userLogin'] = '';
        }
        if (!isset($data['orderId'])) {
            $data['orderId'] = '';
        }
        if (!isset($data['datePayment'])) {
            $data['datePayment'] = '';
        }
        if (!isset($data['dateOrder'])) {
            $data['dateOrder'] = '';
        }
        if (!isset($data['trackingNumber'])) {
            $data['trackingNumber'] = '';
        }

        return $this->render('WojtekOrderBundle:Post:index.html.twig', array(
                    'entities' => $entities,
                    'form' => $this->createSearchForm($data)->createView(),
        ));
    }

    /**
     * Creates a new Post entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Post();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('post_show', array('id' => $entity->getId())));
        }

        return $this->render('WojtekOrderBundle:Post:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Post entity.
     *
     * @param Post $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Post $entity) {
        $form = $this->createForm(new PostType(), $entity, array(
            'action' => $this->generateUrl('post_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Post entity.
     *
     */
    public function newAction() {
        $entity = new Post();
        $form = $this->createCreateForm($entity);

        return $this->render('WojtekOrderBundle:Post:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    public function newFromFileAction() {

        $form = $this->createAddFromFileForm();

        return $this->render('WojtekOrderBundle:Post:new_from_file.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function addFromFileAction(Request $request) {


        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $form = $this->createAddFromFileForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $crawler = new Crawler();
            $xml_content = file_get_contents($form['attachment']->getData());
            $array = $serializer->decode($xml_content, 'xml');
            var_dump($array);
            die();
            return $this->redirect($this->generateUrl('post_show', array('id' => $entity->getId())));
        }

        var_dump($file);
        die();
    }

    /**
     * Finds and displays a Post entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WojtekOrderBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('WojtekOrderBundle:Post:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WojtekOrderBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('WojtekOrderBundle:Post:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Post entity.
     *
     * @param Post $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Post $entity) {
        $form = $this->createForm(new PostType(), $entity, array(
            'action' => $this->generateUrl('post_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Post entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WojtekOrderBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('post'));
        }

        return $this->render('WojtekOrderBundle:Post:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    public function updatePaymentStatusAction($id) {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WojtekOrderBundle:Post')->find($id);

        $entity->setUserPaid(TRUE);

        $em->flush();

        return $this->redirect($this->generateUrl('post'));
    }

    /**
     * Deletes a Post entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('WojtekOrderBundle:Post')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Post entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('post'));
    }

    /**
     * Creates a form to delete a Post entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('post_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

    private function createSearchForm($data) {
        return $this->createFormBuilder()
                        ->setMethod('GET')
                        ->setAction($this->generateUrl('post'))
                        ->add('userLogin', 'text', array(
                            'label' => 'Nazwa kupującego',
                            'required' => false,
                            'data' => $data['userLogin']
                        ))
//                        ->add('datePayment', 'date', array(
//                            'widget' => 'single_text',
//                            'format' => 'dMy',
//                            'label' => 'Data płatności',
//                            'required' => false
//                        ))
//                        ->add('dateOrder', 'date', array(
//                            'widget' => 'single_text',
//                            'format' => 'dMy',
//                            'label' => 'Data zamówienia',
//                            'required' => false
//                        ))
                        ->add('orderId', 'text', array(
                            'label' => 'Id zamówienia',
                            'required' => false,
                            'data' => $data['orderId']
                        ))
                        ->add('trackingNumber', 'text', array(
                            'label' => 'Numer śledzenia',
                            'required' => false,
                            'data' => $data['trackingNumber']
                        ))
                        ->add('Szukaj', 'submit')
                        ->getForm();
    }

    public function createAddFromFileForm() {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('post_add_from_file'))
                        ->setMethod('POST')
                        ->add('attachment', 'file')
                        ->add('Dodaj', 'submit')
                        ->getForm()
        ;
    }

}
