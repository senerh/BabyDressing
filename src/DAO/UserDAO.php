<?php

namespace BabyDressing\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use BabyDressing\Domain\User;

class UserDAO extends DAO implements UserProviderInterface
{
    /**
     * Returns a user matching the supplied id.
     *
     * @param integer $id The user id.
     *
     * @return \BabyDressing\Domain\User|throws an exception if no matching user is found
     */
    public function find($id) {
        $sql = "select * from Utilisateur where user_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No user matching id " . $id);
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($username)
    {
        $sql = "select * from Utilisateur where user_username=?";
        $row = $this->getDb()->fetchAssoc($sql, array($username));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return 'BabyDressing\Domain\User' === $class;
    }

    /**
     * Creates a User object based on a DB row.
     *
     * @param array $row The DB row containing User data.
     * @return \BabyDressing\Domain\User
     */
    protected function buildDomainObject($row) {
        $user = new User();
        $user->setId($row['user_id']);
        $user->setNom($row['user_nom']);
        $user->setPrenom($row['user_prenom']);
        $user->setUsername($row['user_username']);
        $user->setPassword($row['user_password']);
        $user->setSalt($row['user_salt']);
        $user->setRole($row['user_role']);
        $user->setNumero($row['user_numero']);
        $user->setRue($row['user_rue']);
        $user->setCodePostal($row['user_codePostal']);
        $user->setVille($row['user_ville']);
        $user->setTelephone($row['user_telephone']);

        return $user;
    }
    
    
    /**
     * Saves a user into the database.
     *
     * @param \BabyDressing\Domain\User $user The user to save
     */
    public function save(User $user) {
        $userData = array(
        	'user_nom' => $user->getNom(),
        	'user_prenom' => $user->getPrenom(),
            'user_username' => $user->getUsername(),
            'user_salt' => $user->getSalt(),
            'user_password' => $user->getPassword(),
            'user_role' => 'ROLE_USER',
            'user_numero' => $user->getNumero(),
            'user_rue' => $user->getRue(),
            'user_codePostal' => $user->getCodePostal(),
            'user_ville' => $user->getVille(),
            'user_telephone' => $user->getTelephone()
            
            );

        if ($user->getId()) {
            // The user has already been saved : update it
            $this->getDb()->update('Utilisateur', $userData, array('user_id' => $user->getId()));
        } else {
            // The user has never been saved : insert it
            $this->getDb()->insert('Utilisateur', $userData);
            // Get the id of the newly created user and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $user->setId($id);
        }
        
        
    }
        
}