<?php


namespace App\Repository;


interface ProductRepositoryInterface
{
public function getAll();
public function update($obj);
public function destroy($obj);

}
