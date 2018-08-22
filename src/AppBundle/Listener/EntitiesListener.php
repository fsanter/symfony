<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 22/08/2018
 * Time: 10:12
 */

namespace AppBundle\Listener;


use AppBundle\Entity\Article;
use AppBundle\Entity\Category;
use Doctrine\ORM\Event\LifecycleEventArgs;

class EntitiesListener
{

    public function prePersist(LifecycleEventArgs $args) {
        $em = $args->getEntityManager();
        $entity = $args->getEntity();

        // vérifier pour toutes les entités si elles est ont
        // une méthode setCreatedAt
        // pour stter automatiquement la date de création
        if (method_exists ($entity, 'setCreatedAt')) {
            $now = new \DateTime();
            $entity->setCreatedAt($now);
        }

        if ($entity instanceof Article) {
            // prepersist d'un article
            $entity->setCreatedAt(new \DateTime());
        }
        elseif ($entity instanceof Category) {

        }
    }

    public function preUpdate(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        if (method_exists ($entity, 'setUpdatedAt')) {
            $now = new \DateTime();
            $entity->setUpdatedAt($now);
        }
    }
    
    public function preRemove() {

    }
    public function postPersist() {

    }
    public function postUpdate() {

    }

}