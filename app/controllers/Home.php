<?php
class Home extends Controller
{
    public function index()
    {
        $data['title'] = 'Landing Page';
        $data['subtitle'] = 'Produk eKantin STIS';
        // $data['user'] = $this->model('UserModel')->getUserByUsername('afrizal');
        $data['products'] = $this->model('ProductModel')->getAllProducts();
        $data['canteens'] = $this->model('UserModel')->getAllCanteens();

        $this->load('header');
        $this->load('navigation');
        $this->view('home/index', $data);
        $this->load('footer');
    }
}