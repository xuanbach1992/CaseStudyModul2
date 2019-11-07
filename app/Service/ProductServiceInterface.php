<?php


namespace App\Service;


interface ProductServiceInterface
{
    function show();
    function findById($id);
    function success($obj);
}
