<?php

namespace App\Controllers;

use App\Controllers\bdd;

class EventsController extends bdd{

    /**
     * Récupère les evenements commencant entre 2 dates
     * @param \DateTimeInterface $start
     * @param \DateTimeInterface $end
     * @return array
     */
    public function getEventsBetween (\DateTimeInterface $start,\DateTimeInterface $end): array {
        session_start();
        $valueStart = $start->format('Y-m-d 00:00:00');
        $valueEnd = $end->format('Y-m-d 23:59:59');
        $req = "SELECT * FROM t_calendrier_events 
        WHERE id_utilisateur = :id_user AND start_event 
        BETWEEN :value_start AND :value_end 
        ORDER BY start_event ASC";
        $result=$this->getBdd()->prepare($req);
        $result->execute([
            "id_user" => $_SESSION['id_utilisateur'],
            "value_start" => $valueStart,
            "value_end" => $valueEnd
        ]);
        $resultrow=$result->fetch(\PDO::FETCH_ASSOC);
        return $resultrow;
    }

    /**
     * Récupère les evenements d'un jour
     * @param \DateTimeInterface $date
     * @return array
     */
    public function getEvents (\DateTimeInterface $date) {
        $req = "SELECT * FROM t_calendrier_events 
        INNER JOIN t_utilisateur 
        ON t_utilisateur.ID_utilisateur = t_calendrier_events.id_utilisateur  
        WHERE start_event BETWEEN '{$date->format('Y-m-d 00:00:00')}' AND '{$date->format('Y-m-d 23:59:59')}' 
        ORDER BY start_event ASC";
        $result = $this->getBdd()->query($req);
        $resulthrow = $result->fetchAll();
        return $resulthrow;
    }

    /**
     * Récupère les evenements commencant entre 2 dates indexé par jour
     * @param \DateTimeInterface $start
     * @param \DateTimeInterface $end
     * @return array
     */
    public function getEventsBetweenByDay (\DateTimeInterface $start,\DateTimeInterface $end): array {
        $events = $this->getEventsBetween($start, $end);
        $days = [];
        foreach ($events as $event){
            $date = explode(' ',$event['start_event'])[0];
            if (!isset($days[$date])) {
                $days[$date] = [$event];
            } else {
                $days[$date][] = $event;
            }
        }
        return $days;
    }

    /**
     * Récupère un événement avec une id dans une url
     * @return EventsController
     * @throws \Exception
     */
    public function findInUrlId(): EventsController {
        $statement = $this->getBdd()->query('SELECT * FROM t_calendrier_events  
        INNER JOIN t_utilisateur 
        ON t_utilisateur.ID_utilisateur = t_calendrier_events.id_utilisateur 
        WHERE id_event ='.$_GET['id_event'].' ');
        $statement->setFetchMode(\PDO::FETCH_CLASS, Event::class);
        $result = $statement->fetch();
        if ($result === false) {
            throw new \Exception('Aucun résultat n\'a été trouvé.');
        }
        return $result;
    }

    /**
     * Créer un evement dans la bdd
     */
    public function create(EventsController $event) {
        $statement = $this->getBdd()->prepare('INSERT INTO t_calendrier_events (nom_event, desc_event, start_event, end_event, id_utilisateur) 
        VALUES (?, ?, ?, ?, ?) ');
        return $statement->execute([
            $event->getName(),
            $event->getDesc(),
            $event->getStart()->format('Y-m-d H:i:s'),
            $event->getEnd()->format('Y-m-d H:i:s'),
            $event->getIdUser()
        ]);
    }

    /**
     * Modifie un événement de la bdd
     */
    public function update(EventsController $event): bool {
        $statement = $this->getBdd()->prepare('UPDATE t_calendrier_events 
        SET nom_event=?, desc_event=?, start_event=?, end_event=? WHERE id_event = ? AND id_utilisateur='.$_SESSION['id_utilisateur'].'');
        return $statement->execute([
            $event->getName(),
            $event->getDesc(),
            $event->getStart()->format('Y-m-d H:i:s'),
            $event->getEnd()->format('Y-m-d H:i:s'),
            $event->getId()
        ]);
    }

    /**
     * Supprime un événement d'une date
     */
    public function deleteDate() {
        $statement = $this->getBdd()->prepare('DELETE FROM t_calendrier_events WHERE id_event = '.$_GET['id_event'].' AND id_utilisateur='.$_SESSION['id_utilisateur'].'');
        $statement->execute();
    }

    /**
     * Supprime un utilisateur (fonction admin)
     */
    public function DeleteUser() {
        $statement = $this->getBdd()->prepare('DELETE FROM t_utilisateur WHERE ID_utilisateur = '.$_GET['id_user'].'');
        $statement->execute();
    }

    /**
     * Récupère un utilisateur avec une id dans une url
     * @return EventsController
     * @throws \Exception
     */
    public function findInUrlIdUser(): EventsController {
        $statement = $this->getBdd()->query('SELECT * FROM t_utilisateur 
        WHERE ID_utilisateur ='.$_GET['id_user'].' ');
        $statement->setFetchMode(\PDO::FETCH_CLASS, Event::class);
        $result = $statement->fetch();
        if ($result === false) {
            throw new \Exception('Aucun résultat n\'a été trouvé.');
        }
        return $result;
    }

}