<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Virements Controller
 *
 * @property \App\Model\Table\VirementsTable $Virements
 *
 * @method \App\Model\Entity\Virement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VirementsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $user= $this->Auth->user();
        $requete = $this->Virements;
        if($user['role'] != 'admin'){
            $requete = $this->Virements->find('all')->where(['user_id' => $user['id']]);
        }
        $this->paginate = [
            'contain' => ['Comptes', 'Users']
        ];
        $virements = $this->paginate($requete);

        $this->set(compact('virements'));
    }

    /**
     * View method
     *
     * @param string|null $id Virement id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $virement = $this->Virements->get($id, [
            'contain' => ['Comptes', 'Users']
        ]);

        $this->set('virement', $virement);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $virement = $this->Virements->newEntity();

        if ($this->request->is('post')) {
            $virement = $this->Virements->patchEntity($virement, $this->request->getData());
            if ($this->Virements->save($virement)) {
                $this->Flash->success(__('Le virement a été sauvegardé.'));
                $compte = $this->Virements->Comptes->get($virement['compte_id']);
                $compte->balance -= $virement['montant'];
                $this->Virements->Comptes->save($compte);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Le virement n\'a pas pu être sauvegardé. Veuillez réessayer'));
        }
        $user_id = $this->Auth->user('id');
        $comptes = $this->Virements->Comptes->find('list', ['limit' => 200, 'valueField' => 'nom']);
        $comptes->matching('Users', function ($q) use ($user_id) {
            return $q->where(['Users.id' => $user_id]);
        });
        $users = $this->Virements->Users->find('list', ['limit' => 200]);
        $this->set(compact('virement', 'comptes', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Virement id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $virement = $this->Virements->get($id, [
            'contain' => ['Comptes']
        ]);
        $compte = $virement->compte;
        $compte->balance += $virement->montant;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $virement = $this->Virements->patchEntity($virement, $this->request->getData());
            if ($this->Virements->save($virement)) {
                $this->Flash->success(__('Le virement a été sauvegardé.'));
                $compte['balance'] -= $virement['montant'];
                $this->Virements->Comptes->save($compte);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Le virement n\'a pas pu être sauvegardé. Veuillez réessayer'));
        }
        $comptes = $this->Virements->Comptes->find('list', ['limit' => 200]);
        $users = $this->Virements->Users->find('list', ['limit' => 200, 'valueField' => 'username']);
        $this->set(compact('virement', 'comptes', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Virement id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $virement = $this->Virements->get($id, [
            'contain' => ['Comptes']
        ]);
        $compte = $virement->compte;
        if ($this->Virements->delete($virement)) {
            $this->Flash->success(__('Le virement a été supprimé.'));
            $compte['balance'] += $virement['montant'];
            $this->Virements->Comptes->save($compte);
        } else {
            $this->Flash->error(__('Le virement n\'a pas pu être supprimé. Veuillez réessayer'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');

        if($user['role'] == 'admin'){
            return true;
        }else{
            if (in_array($action, ['add', 'index'])) {
                return true;
            }

            $id = $this->request->getParam('pass.0');
            if (!$id) {
                return false;
            }
            // On vérifie que le virement appartient à l'utilisateur connecté
            $virement = $this->Virements->findById($id) -> contain(['Users']) -> first();
            $userVirement = $virement->user;
            if($userVirement['id'] === $user['id']){
                return true;
            }

        }

    }
}
