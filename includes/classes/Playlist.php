<?php

    class Playlist {

        private $dbConnection;
        private $id;
        private $name;
        private $owner;
        private $dateMade;

        public function __construct($dbConnection, $data) {
            //Constructor

            if(!is_array($data)) {
                $query = mysqli_query($dbConnection, "SELECT * FROM playlists WHERE id='$data'");
                $data = mysqli_fetch_array($query);
                //converts data into an array so that other pages can use it.
            }


            $this->dbConnection = $dbConnection;
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->owner = $data['owner'];
            $this->dateMade = $data['dateMade'];
        }

        public function getId(){
            return $this->id;
        }

        public function getTheName(){
            return $this->name;
        }

        public function getOwner(){
            return $this->owner;
        }

        public function getDateMade(){
            return $this->dateMade;
        }

        public function getSongTotal(){
            $songTotal = mysqli_query($this->dbConnection, "SELECT songId FROM playlistSongs WHERE playlistId ='$this->id'");
            return mysqli_num_rows($songTotal);
        }

        public function getSongIds() {
            $getSong = mysqli_query($this->dbConnection, "SELECT songId FROM playlistSongs WHERE playlistId='$this->id' ORDER BY songOrder ASC");
            $songArray = array();
            while($songRow = mysqli_fetch_array($getSong)) {
                array_push($songArray, $songRow['songId']);
            }
            return $songArray;
        }

        public static function getPlaylistDropdown($dbConnection, $username) {
            $dropdown = '<select class="playlist item">
                            <option value="">Add to playlist</option>';
            $query = mysqli_query($dbConnection, "SELECT id, name FROM playlists WHERE owner='$username'");            
            while($songRow = mysqli_fetch_array($query)) {
                $id = $songRow['id'];
                $name = $songRow['name'];

                $dropdown = $dropdown . "<option value='$id'>$name</option>";
            }

            return $dropdown . "</select>";
        }

    }
?>