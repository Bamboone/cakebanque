<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Comptes Controller
 *
 * @property \App\Model\Table\ComptesTable $Comptes
 *
 * @method \App\Model\Entity\Compte[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ComptesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {

        $requete = $this->Comptes->find('all') -> contain(['Users']);
        $comptes = $this->paginate($requete);
        $this->set(compact('comptes'));
    }

    /**
     * View method
     *
     * @param string|null $id Compte id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $compte = $this->Comptes->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('compte', $compte);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $compte = $this->Comptes->newEntity();
        if ($this->request->is('post')) {
            $compte = $this->Comptes->patchEntity($compte, $this->request->getData());

            $compte->user_id = $this->Auth->user('id');

            if ($this->Comptes->save($compte)) {
                $this->Flash->success(__('The compte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The compte could not be saved. Please, try again.'));
        }
        $users = $this->Comptes->Users->find('list', ['limit' => 200]);
        $this->set(compact('compte', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Compte id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $compte = $this->Comptes->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $compte = $this->Comptes->patchEntity($compte, $this->request->getData(), [
                'accessibleFields' => ['user_id' => false]
            ]);

            if ($this->Comptes->save($compte)) {
                $this->Flash->success(__('The compte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The compte could not be saved. Please, try again.'));
        }
        $users = $this->Comptes->Users->find('list', ['limit' => 200]);
        $this->set(compact('compte', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Compte id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $compte = $this->Comptes->get($id);
        if ($this->Comptes->delete($compte)) {
            $this->Flash->success(__('The compte has been deleted.'));
        } else {
            $this->Flash->error(__('The compte could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // Les actions 'add' sont toujours autorisés pour les utilisateur
        // authentifiés sur l'application
        if (in_array($action, ['add'])) {
            return true;
        }

        // Toutes les autres actions nécessitent un slug
        $id = $this->request->getParam('pass.0');
        if (!$id) {
            return false;
        }

        // On vérifie que l'article appartient à l'utilisateur connecté
        $compte = $this->Comptes->find('ownedBy', ['user'=>$user]);

        return $compte->user_id === $user['id'];
    }
}
