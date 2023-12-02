<?php
class ProductModel {
    public function getProductLists() {
        return [
            [
                "url_img" => _WEB_ROOT."/public/assets/clients/images/sanpham1.png",
                "name" => "Áo gucci",
                "price" => 53,
                "root-price" => 100
            ],
            [
                "url_img" => _WEB_ROOT."/public/assets/clients/images/sanpham2.png",
                "name" => "Áo khoác gió",
                "price" => 75.55,
                "root-price" => 150
            ],
            [
                "url_img" => _WEB_ROOT."/public/assets/clients/images/sanpham3.png",
                "name" => "Áo thun rộng",
                "price" => 75.55,
                "root-price" => 150
            ],
            [
                "url_img" => _WEB_ROOT."/public/assets/clients/images/sanpham4.png",
                "name" => "áo thung cổ tròn",
                "price" => 75.55,
                "root-price" => 150
            ]
        ];
    }

    public function getDetail($id) {
        $data = [
            'Sản phẩm 1',
            'Sản phẩm 2',
            'Sản phẩm 3'
        ];
        return $data[$id];
    }

    public function getImgDescriptions() {
        $data = [
            _WEB_ROOT."/public/assets/clients/images/description-1.webp",
            _WEB_ROOT."/public/assets/clients/images/description-2.webp",
            _WEB_ROOT."/public/assets/clients/images/description-3.webp",
            _WEB_ROOT."/public/assets/clients/images/description-4.webp",
            _WEB_ROOT."/public/assets/clients/images/description-5.webp",
            _WEB_ROOT."/public/assets/clients/images/description-6.webp"
        ];
        return $data;
    }
}
?>