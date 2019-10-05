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
        $user_id = $this->Auth->user('id');
        $requete = $this->Comptes->find('all');
        if($this->Auth->user('role') != 'admin'){
            $requete->matching('Users', function ($q) use ($user_id) {
                return $q->where(['Users.id' => $user_id]);
            });
        }
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
            'contain' => ['Users', 'Transactions', 'Files']
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

            if ($this->Comptes->save($compte)) {
                $this->Flash->success(__('Le compte a été sauvegardé.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Le compte n\'a pas pu être sauvegardé, veuillez réessayer.'));
        }
        $users = $this->Comptes->Users->find('list', ['limit' => 200]);
        $files = $this->Comptes->Files->find('list', ['limit' => 200]);
        $this->set(compact('compte', 'users', 'files'));
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
            $compte = $this->Comptes->patchEntity($compte, $this->request->getData());

            if ($this->Comptes->save($compte)) {
                $this->Flash->success(__('Le compte a été sauvegardé.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Le compte n\'a pas pu être sauvegardé, veuillez réessayer.'));
        }
        $users = $this->Comptes->Users->find('list', ['limit' => 200]);
        $files = $this->Comptes->Files->find('list', ['limit' => 200]);
        $this->set(compact('compte', 'users', 'files'));
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
            $this->Flash->success(__('Le compte a été supprimé.'));
        } else {
            $this->Flash->error(__('Le compte n\'a pas pu être supprimé, veuillez réessayer.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // Les actions 'add' sont toujours autorisés pour les utilisateur
        // authentifiés sur l'application
        if($user['role'] == 'admin'){
            return true;
        }else{
            if (in_array($action, ['add', 'index'])) {
                return true;
            }

            // Toutes les autres actions nécessitent un utilisateur connecté
            $id = $this->request->getParam('pass.0');
            if (!$id) {
                return false;
            }
            // On vérifie que le compte appartient à l'utilisateur connecté
            $compte = $this->Comptes->findById($id) -> contain(['Users']) -> first();
            $trouve = false;
            $listeUsers = $compte->users;
            foreach ($listeUsers as $users):

                if($users->get('id') === $user['id']){
                    $trouve = true;
                }
            endforeach;
            return $trouve;
        }

    }
}
