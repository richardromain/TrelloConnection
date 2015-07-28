<?php

/**
* Class TrelloHelper
* Permet de communiquer avec l'API de Trello
*/
class TrelloHelper
{

    /**
     * @var string Clé pour accéder à l'API de Trello
     */
    const KEY_APP = '7842bd0dbfbaa834640d2af8618de468';

    /**
     * @var string Token pour identifer un compte dans l'API de Trello
     */
    const TOKEN_APP = 'c7f4c068347576a218f6e1fd257ff93e5eca482b86260e2e2aa1fb2bc177e580';

    /**
     * Fonction permettant de récupérer les lists d'une board
     * @param  string $id_board  contient l'id de la board Trello
     * @return Object contient la réponse donnée par l'API de Trello
     */
    public static function get_lists($id_board)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://trello.com/1/board/$id_board/lists?key=".self::KEY_APP."&token=".self::TOKEN_APP."&cards=open");
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $return = curl_exec($ch);
        curl_close($ch);

        return $return;
    }

    /**
     * Fonction permettant de récupérer la liste des membres d'une board
     * @param  string $id_board  contient l'id de la board Trello
     * @return Object contient la réponse donnée par l'API de Trello
     */
    public static function get_members_board($id_board)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://trello.com/1/board/$id_board/members?key=".self::KEY_APP."&token=".self::TOKEN_APP);
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $return = curl_exec($ch);
        curl_close($ch);

        return $return;
    }

    /**
     * Fonction permettant d'ajouter une card à une list
     * @param string $id_list   contient l'id de la list dans laquelle on souhaite ajouter la card
     * @param string $name      contient le nom de la card
     * @param string $desc      contient la description de la card
     * @param string $labels    contient le label que l'on souhaite mettre sur la card
     * @param string $id_member    contient l'id du membre qui est assigné à cette card
     * @param date $due    contient la date limite pour réaliser la card. Le format est le suivant : mm/jj/aaaa
     * @return Object contient la réponse donnée par l'API de Trello
     */
    public static function add_card_to_list($id_list, $name=null, $desc=null, $due=null, $labels=null, $id_member=null)
    {
        $data = [
            'idList' => $id_list,
            'name' => $name,
            'desc' => $desc,
            'labels' => $labels,
            'idMembers' => $id_member,
            'due' => $due
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://trello.com/1/card?key=".self::KEY_APP."&token=".self::TOKEN_APP);
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $return = curl_exec($ch);
        curl_close($ch);

        return $return;
    }

}
