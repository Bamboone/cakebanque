<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

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
        $requete = $this->Comptes->find('all');
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
            'contain' => ['Users', 'Transactions', 'Files', 'Institutions' => ['Villes']]
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

        $this->loadModel('Villes');
        $villes = $this->Villes->find('list', ['limit' => 200, 'valueField'=>'nom']);

        $villes = $villes->toArray();
        reset($villes);
        $ville_id = key($villes);

        $institutions = $this->Comptes->Institutions->find('list', [
            'conditions' => ['Institutions.ville_id' => $ville_id],
        ]);

        $users = $this->Comptes->Users->find('list', ['limit' => 200, 'valueField'=>'username']);
        $files = $this->Comptes->Files->find('list', ['limit' => 200]);
        $this->set(compact('compte', 'users', 'files', 'villes', 'institutions'));
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
            'contain' => ['Users', 'Files', 'Institutions' => ['Villes']]
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $compte = $this->Comptes->patchEntity($compte, $this->request->getData());

            if ($this->Comptes->save($compte)) {
                $this->Flash->success(__('Le compte a été sauvegardé.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Le compte n\'a pas pu être sauvegardé, veuillez réessayer.'));
        }
        $users = $this->Comptes->Users->find('list', ['limit' => 200, 'valueField'=>'username']);
        $files = $this->Comptes->Files->find('list', ['limit' => 200]);
        $this->loadModel('Villes');
        $villes = $this->Villes->find('list', ['limit' => 200, 'valueField'=>'nom']);
        $institutions = $this->Comptes->Institutions->find('list', [
            'conditions' => ['Institutions.ville_id' => $compte->institution->ville_id],
        ]);
        $this->set(compact('compte', 'users', 'files', 'institutions', 'villes'));
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
        if($user['role'] == 'admin'){
            return true;
        }else {
            return false;
        }

    }
}
