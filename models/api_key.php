<?php
class Api_Key {
    
    private int $id;
    private string $api_key;

	public function getId() : int {
		return $this->id;
	}

	public function setId(int $value) {
		$this->id = $value;
	}

	public function getApi_key() : string {
		return $this->api_key;
	}

	public function setApi_key(string $value) {
		$this->api_key = $value;
	}
}