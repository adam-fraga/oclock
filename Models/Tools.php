<?php
require_once 'App/db.php';

class Tools extends DB
{

    /** Return the list of alarms in DB
     * @return array
     */
    public function displayAlarms(): array
    {
        $sql = "SELECT * FROM alarmes.alarmes";
        return $this->getLink()->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }

    /** Insert alarms and user's message ind DB
     * @param int $hour //Hour of the alarm
     * @param int $min //Min of the alarm
     * @param string $msg //User's Message
     * @return bool //Result of the request
     */
    public function insertAlarms(int $hour, int $min, string $msg): bool
    {
        intval($min) < 10 ? $min = '0' . $min : '';
        intval($hour) < 10 ? $hour = 0 . $hour : '';

        $sql = "INSERT INTO alarmes.alarmes (heures, minutes,message) VALUE (?,?,?) ";
        $stmt = $this->getLink()->prepare($sql);
        $stmt->bindValue(1, $hour);
        $stmt->bindValue(2, $min);
        $stmt->bindValue(3, $msg);

        return $stmt->execute();
    }

    /** Secure an user post
     * @param $userPost User's entry
     * @return string
     */
    public function securePost($userPost): string
    {
        $userPost = htmlspecialchars($userPost);
        return $userPost = strip_tags($userPost);
    }
}