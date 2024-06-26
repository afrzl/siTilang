<?php

class Canteen extends Controller
{
    public function index($email = null)
    {
        $canteen = $this->model('UserModel')->getUserByEmail($email);
        $data['title'] = 'Landing Page';
        $data['subtitle'] = 'Produk ' . $canteen['name'];
        $data['canteen_id'] = $canteen['id'];
        $data['category_id'] = '';

        $data['products'] = $this->model('ProductModel')->getProductsByCanteen($canteen['id']);
        $data['canteens'] = $this->model('UserModel')->getAllCanteens();

        $this->load('header');
        $this->load('navigation');
        $this->view('home/index', $data);
        $this->load('footer');
    }
}