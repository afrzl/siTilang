<?php

class Product extends Controller
{
    public function index($slug = null)
    {
        $data['title'] = 'Product ' . $slug;
        $data['product'] = $this->model('ProductModel')->getProductBySlug($slug);
        $data['product']['canteen'] = $this->model('UserModel')->getUserById($data['product']['canteen_id']);
        $data['canteens'] = $this->model('UserModel')->getAllCanteens();
        $data['products'] = $this->model('ProductModel')->getProductsByCanteen($data['product']['canteen']['id']);

        $this->load('header');
        $this->load('navigation');
        $this->view('product/index', $data);
        $this->load('footer');
    }
}