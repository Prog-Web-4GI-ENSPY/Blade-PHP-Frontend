const allProducts = [

    // Page 1 - Mélange complet (premium/entrée de gamme)
    { name: "Asus ROG Phone 9 Pro", price: 850000, rating: 4.8, brand: "Asus", image: "https://www.gamereactor.dk/media/64/asusrogphone_4396473b.png" },
    { name: "Alcatel 1", price: 38000, rating: 3.2, brand: "Alcatel", image: "https://th.bing.com/th/id/OIP.dseHP53-H_rBVGi7cWfGdgHaHa?o=7&cb=12rm=3&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Google Pixel 9", price: 750000, rating: 4.6, brand: "Google", image: "https://static1.anpoimages.com/wordpress/wp-content/uploads/2024/08/google-pixel-9-pro.png" },
    { name: "Itel City 100", price: 43000, rating: 3.6, brand: "Itel", image: "https://gizmologi.id/wp-content/uploads/2025/05/Itel-City-100-5.jpg" },
    { name: "Honor Magic V Flip", price: 780000, rating: 4.7, brand: "Honor", image: "https://img.tuttoandroid.net/wp-content/uploads/2025/07/HONOR-Magic-V-Flip.jpg" },
    { name: "Tecno Pop 9", price: 48000, rating: 3.7, brand: "Tecno", image: "https://ares.shiftdelete.net/2024/09/TECNO-POP-9-5G-tanitildi-Iste-ozellikleri-ve-fiyati.jpg" },
    { name: "Iphone 16", price: 850000, rating: 4.2, brand: "Iphone", image: "https://dicas.olx.com.br/wp-content/uploads/2024/10/iphone-16-lancamento-recursos.jpg" },
    { name: "Wiko Jerry 3", price: 42000, rating: 3.1, brand: "Wiko", image: "https://www.notebookcheck.net/fileadmin/_processed_/5/2/csm_Wiko_Jerry_3_5_8b05d06db5.jpg" },
    { name: "Xiaomi 14 Ultra", price: 620000, rating: 4.7, brand: "Xiaomi", image: "https://external-preview.redd.it/xiaomi-14-ultra-price-and-specifications-v0-Y0M0-raYrKQVsZkvQak0B0_8-F5k0VYYIikKcu9DkJQ.jpg?width=640&crop=smart&auto=webp&s=3cf38920179aa892a7cb57ffd689855c8023db82" },
    { name: "Innjoo Fire 2 Plus", price: 48000, rating: 3.0, brand: "Innjoo", image: "https://www.gizlogic.com/wp-content/uploads/2016/08/Gizlogic-InnJoo-FIRE-2-PLUS-1-767x1190-1-1024x768.jpg" },
    { name: "Oppo Find X8 Pro", price: 720000, rating: 4.8, brand: "Oppo", image: "https://insiderkenya.com/wp-content/uploads/2024/11/Oppo-Find.webp" },
    { name: "Haier G30", price: 38000, rating: 3.0, brand: "Haier", image: "https://www.phoneworld.com.pk/wp-content/uploads/2015/03/Haier-G30-Review-6.jpg" },

    // Page 2 - Mélange varié (toutes gammes)
    { name: "Samsung Galaxy S10", price: 195000, rating: 3.7, brand: "Samsung", image: "https://fdn.gsmarena.com/imgroot/reviews/19/samsung-galaxy-s10/gal/-1024w2/gsmarena_001.jpg" },
    { name: "OnePlus 13", price: 680000, rating: 4.6, brand: "OnePlus", image: "https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1x126t.img?w=1200&h=675&m=4&q=91" },
    { name: "Microsoft Lumia 435", price: 38000, rating: 3.0, brand: "Microsoft", image: "https://www.mobiledor.com/wp-content/uploads/Microsoft-Lumia-435.webp" },
    { name: "Vivo X90", price: 480000, rating: 4.5, brand: "Vivo", image: "https://th.bing.com/th/id/OIP.ALThGTl1ya70-0VxWl6NYwHaHa?o=7&cb=12rm=3&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "ZTE Blade A33", price: 48000, rating: 3.3, brand: "ZTE", image: "https://www.powerplanetonline.com/cdnassets/zte_blade_a33_core_gris_01_l.jpg" },
    { name: "Iphone 14", price: 580000, rating: 4.5, brand: "Iphone", image: "https://i2.wp.com/imgix.bustle.com/uploads/image/2022/9/7/9fce650c-28aa-4995-81f4-ac72d963485b-iphone14.png" },
    { name: "Elephone C1", price: 55000, rating: 3.1, brand: "Elephone", image: "https://th.bing.com/th/id/R.ca0c11a4211b6a0572a8e3495e00162f?rik=PF8n%2f8hXNc71ig&pid=ImgRaw&r=0" },
    { name: "Huawei P60", price: 580000, rating: 4.4, brand: "Huawei", image: "https://th.bing.com/th/id/OIP.XNVqqv3YfG5RqwOFRMSIhgHaI2?o=7&cb=12rm=3&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Alcatel U3", price: 42000, rating: 3.1, brand: "Alcatel", image: "https://tse1.mm.bing.net/th/id/OIP.uGyl5lRhBGo6BKPuvZDcJAHaHa?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Motorola Razr 50 Ultra", price: 650000, rating: 4.3, brand: "Motorola", image: "https://th.bing.com/th/id/OIP.G4dX7hV3qzyc9KsbPcbj2gHaGP?o=7&cb=12rm=3&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "LG K31", price: 72000, rating: 3.6, brand: "LG", image: "https://www.gizmochina.com/wp-content/uploads/2020/08/LG-K31-1-500x500.jpg" },
    { name: "Itel A90", price: 52000, rating: 3.9, brand: "Itel", image: "https://fdn2.gsmarena.com/vv/pics/itel/itel-a90-2.jpg" },

    // Page 3 - Mélange varié (milieu/bas de gamme)
    { name: "Asus Zenfone 12 Ultra", price: 780000, rating: 4.7, brand: "Asus", image: "https://xiaomiui.net/wp-content/uploads/2025/02/Asus-Zenfone-12-Ultra.png" },
    { name: "Tecno Spark 7", price: 62000, rating: 3.5, brand: "Tecno", image: "https://www.gizmochina.com/wp-content/uploads/2021/04/banner-pc.jpg" },
    { name: "Xiaomi 17 Pro", price: 520000, rating: 4.6, brand: "Xiaomi", image: "https://images.frandroid.com/wp-content/uploads/2025/09/xiaomi-17-serie.jpg" },
    { name: "Benco Y32", price: 68000, rating: 3.3, brand: "Benco", image: "https://files.gsmchoice.com/phones/benco-y32/benco-y32-01.jpg" },
    { name: "Google Pixel 7", price: 420000, rating: 4.3, brand: "Google", image: "https://www.googlewatchblog.de/wp-content/uploads/pixel-7-pro-smartphones.jpg" },
    { name: "Infinix Smart 10", price: 58000, rating: 3.4, brand: "Infinix", image: "https://www.yatekno.com/wp-content/uploads/2025/06/Infinix-Smart-10.webp" },
    { name: "Realme GT 7 Pro", price: 420000, rating: 4.5, brand: "Realme", image: "https://xiaomiui.net/wp-content/uploads/2024/11/Realme-GT-7-Pro-launch.png" },
    { name: "Itel A80", price: 45000, rating: 3.8, brand: "Itel", image: "https://www.gadgetpilipinas.net/wp-content/uploads/2024/09/Itel-A80-Philippines-4-770x576.jpg" },
    { name: "Honor 400 Pro", price: 520000, rating: 4.3, brand: "Honor", image: "https://www.mobiledokan.com/media/honor-400-pro-black-official-image.webp" },
    { name: "HTC Desire 820", price: 62000, rating: 3.4, brand: "HTC", image: "https://drop.ndtv.com/TECH/product_database/images/1121201463712PM_635_htc_desire_820s.jpeg" },
    { name: "Oppo Reno 13 Pro", price: 480000, rating: 4.5, brand: "Oppo", image: "https://cdn-files.kimovil.com/default/0011/11/thumb_1010494_default_big.jpg" },
    { name: "Wiko View 4", price: 58000, rating: 3.3, brand: "Wiko", image: "https://img.generation-nt.com/wiko-view-4_07CA0A4001665761.jpg" },

    // Page 4 - Mélange varié (toutes marques)
    { name: "CAT S75", price: 420000, rating: 4.4, brand: "CAT", image: "https://tse2.mm.bing.net/th/id/OIP.jF-RKodH9cU-BI73MpjpCwHaIn?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Nokia G42", price: 110000, rating: 3.8, brand: "Nokia", image: "https://tse2.mm.bing.net/th/id/OIP.EHp9ELpWi9Y8F9dJ0oCl2wHaHa?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Iphone 15", price: 720000, rating: 4.4, brand: "Iphone", image: "https://static1.pocketnowimages.com/wordpress/wp-content/uploads/2023/09/pbi-iphone-15.png" },
    { name: "Innjoo Pro 2", price: 45000, rating: 3.1, brand: "Innjoo", image: "https://www.movilzona.es/app/uploads/2017/02/INNJOO-PRO-2-5.jpg" },
    { name: "Samsung Galaxy Note 20", price: 280000, rating: 4.1, brand: "Samsung", image: "https://tse1.explicit.bing.net/th/id/OIP.ifv4th66VNRv4pU3FfQt_gHaIC?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Haier L56", price: 58000, rating: 3.4, brand: "Haier", image: "https://blog.phonehouse.es/wp-content/uploads/2017/03/haier_l56_frontal-1000-768x768.jpg" },
    { name: "Poco F7 Ultra", price: 380000, rating: 4.4, brand: "Poco", image: "https://static.deltiasgaming.com/2025/03/poco-f7-ultra-premium-midrange-smartphone-768x432.jpg" },
    { name: "TCL Mobile", price: 75000, rating: 3.4, brand: "TCL", image: "https://th.bing.com/th/id/OIP.Pz3unL5sGb4l0TTd12iKXQHaFj?o=7&cb=12rm=3&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Vivo X60", price: 245000, rating: 4.2, brand: "Vivo", image: "https://images.techadvisor.com/cmsdata/features/3799468/vivo_x60_full_thumb.jpg" },
    { name: "Blackberry Motion", price: 135000, rating: 3.6, brand: "Blackberry", image: "https://androidcommunity.com/wp-content/uploads/2017/10/BlackBerry-Motion-1.jpg" },
    { name: "OnePlus 12", price: 580000, rating: 4.4, brand: "OnePlus", image: "https://th.bing.com/th/id/OIP.JcLjvF3oov70BY6fo134fAHaHa?o=7&cb=12rm=3&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "ZTE Blade L9", price: 55000, rating: 3.4, brand: "ZTE", image: "https://www.powerplanetonline.com/cdnassets/zte_blade_l9_gris_01_l.jpg" },

    // Page 5 - Mélange varié (premium/budget)
    { name: "Asus ROG Phone 8 Pro", price: 720000, rating: 4.6, brand: "Asus", image: "https://newfortech.com/wp-content/uploads/2024/01/Asus-ROG-Phone-8-Pro.jpg" },
    { name: "Alcatel 1S", price: 52000, rating: 3.3, brand: "Alcatel", image: "https://th.bing.com/th/id/R.2e7cf5f040312e42431f1139229e3c20?rik=nR1zco6Bemp8cg&pid=ImgRaw&r=0" },
    { name: "Motorola Edge 50 Ultra", price: 320000, rating: 4.4, brand: "Motorola", image: "https://tse4.mm.bing.net/th/id/OIP.rOr4o3OJi7mrlIjUHjqOOAHaHa?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Elephone S7", price: 62000, rating: 3.2, brand: "Elephone", image: "https://www.giztop.com/media/catalog/product/cache/dc206057cdd42d7e34b9d36e347785ca/e/l/elephone_s7_b_1.jpg" },
    { name: "Huawei Mate 50", price: 485000, rating: 4.1, brand: "Huawei", image: "https://th.bing.com/th/id/R.c3657491f4036a4b4786b0383b803696?rik=J6praj7pHzuJhQ&pid=ImgRaw&r=0" },
    { name: "Benco S1 Pro", price: 82000, rating: 3.8, brand: "Benco", image: "https://www.mobileinbd.co/wp-content/uploads/2023/06/Benco-S1-Pro-Iceberg-Blue.jpg" },
    { name: "Google Pixel 8", price: 580000, rating: 4.1, brand: "Google", image: "https://fdn2.gsmarena.com/vv/pics/google/google-pixel-8-1.jpg" },
    { name: "Microsoft Lumia 640", price: 45000, rating: 3.3, brand: "Microsoft", image: "https://tse2.mm.bing.net/th/id/OIP.yOUbRcKbS8cnbf2cv1G59gHaGD?cb=12&w=550&h=450&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Xiaomi Redmi Note 14", price: 145000, rating: 3.9, brand: "Xiaomi", image: "https://th.bing.com/th/id/OIP.7aqo8mANM0N2p-CQ4ZbhuQHaEz?o=7&cb=12rm=3&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Samsung A52", price: 185000, rating: 4.2, brand: "Samsung", image: "https://th.bing.com/th/id/OIP.-fMULcZXP1vljwR6A0XzXgHaFn?o=7&cb=12rm=3&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Realme 14 Pro", price: 280000, rating: 4.1, brand: "Realme", image: "https://image01.realme.net/general/20250106/1736141523266936bea99efd84028bad0d2322119d04c.jpg?width=1080&height=1080&size=604565" },
    { name: "Hisense H60 Smart", price: 68000, rating: 3.5, brand: "Hisense", image: "https://cdn-files.kimovil.com/default/0007/44/thumb_643677_default_big.jpg" },

    // Page 6 - Mélange varié (toutes gammes)
    { name: "Nokia HMD Pulse Pro", price: 95000, rating: 4.0, brand: "Nokia", image: "https://www.go2android.de/wp-content/uploads/2024/04/nokia-hmd-pulse_01.jpg" },
    { name: "CAT S62 Pro", price: 380000, rating: 4.3, brand: "CAT", image: "https://m.media-amazon.com/images/I/71WUu+rQMgS.jpg" },
    { name: "Tecno Camon 16", price: 85000, rating: 3.8, brand: "Tecno", image: "https://images.fonearena.com/blog/wp-content/uploads/2021/01/Tecno-Camon-16-Premier-1-1024x971.jpg" },
    { name: "Honor X60i", price: 165000, rating: 3.9, brand: "Honor", image: "https://tse2.mm.bing.net/th/id/OIP.GPiQckbdLK_6lPAWw9haFgHaHa?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Sony Xperia 10 V", price: 285000, rating: 4.0, brand: "Sony", image: "https://spectronic.com.au/wp-content/uploads/2025/09/1-8.png" },
    { name: "Wiko Wim", price: 65000, rating: 3.6, brand: "Wiko", image: "https://th.bing.com/th/id/R.562f250d484c70685d0277403804864f?rik=drOxOKYv4f8Igg&riu=http%3a%2f%2fphonesdata.com%2ffiles%2fmodels%2fWiko-WIM-543.jpg&ehk=GtPiQhmOOOtJHzgPvTvbLk7tpYN735bz1Ql0gibkJDo%3d&risl=&pid=ImgRaw&r=0" },
    { name: "Oppo Reno 8", price: 285000, rating: 4.1, brand: "Oppo", image: "https://tse1.mm.bing.net/th/id/OIP.DWL-XqHo3U5Wsdj-xVblwQHaEL?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Infinix Note 50 Pro", price: 115000, rating: 4.1, brand: "Infinix", image: "https://tse1.mm.bing.net/th/id/OIP.8kRZwmnAGxkXEmtAVLbttgHaHa?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Poco F3", price: 215000, rating: 4.0, brand: "Poco", image: "https://tse2.mm.bing.net/th/id/OIP.C0k4O2h6ZWcwcBqWH9DG7QHaHa?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Blackberry Key2 LE", price: 145000, rating: 3.5, brand: "Blackberry", image: "https://tse1.mm.bing.net/th/id/OIP.rUCBehddqQTwGsM5ADiV7AHaHa?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Iphone 14", price: 580000, rating: 4.5, brand: "Iphone", image: "https://i2.wp.com/imgix.bustle.com/uploads/image/2022/9/7/9fce650c-28aa-4995-81f4-ac72d963485b-iphone14.png" },
    { name: "LG W41 Plus", price: 88000, rating: 3.7, brand: "LG", image: "https://phonesdata.com/files/models/LG-W41+-147.jpg" },

    // Page 7 - Mélange varié (bas/milieu de gamme)
    { name: "OnePlus Nord 4", price: 320000, rating: 4.2, brand: "OnePlus", image: "https://th.bing.com/th/id/OIP.Oaii_GbOjcDkFFsi7yJTQgHaE8?o=7&cb=12rm=3&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Innjoo Max 4 Pro", price: 52000, rating: 3.2, brand: "Innjoo", image: "https://tse1.mm.bing.net/th/id/OIP.QFTPv0lvOkLJ4XCphm4rQgHaF0?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Vivo V21", price: 165000, rating: 4.0, brand: "Vivo", image: "https://th.bing.com/th/id/R.de569a76838b12b8cd4512e211039235?rik=oI65rolMnyz%2bqw&pid=ImgRaw&r=0" },
    { name: "Motorola E13", price: 68000, rating: 3.6, brand: "Motorola", image: "https://www.chooseyourmobile.com/wp-content/uploads/2023/02/Motorola-E13-Image.jpg" },
    { name: "Huawei P50", price: 395000, rating: 4.2, brand: "Huawei", image: "https://tse3.mm.bing.net/th/id/OIP.STrBGRkSHmJ4grfEnI0WPAHaH1?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Hisense Infinty H60", price: 72000, rating: 3.6, brand: "Hisense", image: "https://th.bing.com/th/id/OIP.c7Qgpu5YYMb3k8H0KN7_3QHaHC?o=7&cb=12rm=3&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Realme C75", price: 98000, rating: 3.8, brand: "Realme", image: "https://www.mobiledokan.com/media/realme-c75x-coral-pink-official-image.webp" },
    { name: "Benco V90", price: 75000, rating: 3.5, brand: "Benco", image: "https://api-rayashop.freetls.fastly.net/media/catalog/product/cache/4e49ac3a70c0b98a165f3fa6633ffee1/c/k/ckzvjwh_8qxoen9izdosx7vf.jpg" },
    { name: "Nokia X7", price: 175000, rating: 3.9, brand: "Nokia", image: "https://tse4.mm.bing.net/th/id/OIP.w-Oie83ZTOd7bvwiRW43qgHaFj?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Elephone P9000", price: 68000, rating: 3.3, brand: "Elephone", image: "https://www.giztop.com/media/catalog/product/cache/dc206057cdd42d7e34b9d36e347785ca/e/l/elephone_p9000_2.jpg" },
    { name: "Infinix GT 30 Pro", price: 125000, rating: 4.0, brand: "Infinix", image: "https://tse1.mm.bing.net/th/id/OIP.af9MczrA7Lz9EOdeeeY8xQHaHa?cb=12&w=800&h=800&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "TCL 505", price: 82000, rating: 3.9, brand: "TCL", image: "https://fdn2.gsmarena.com/vv/pics/tcl/tcl-505-2.jpg" },

    // Page 8 - Mélange varié (toutes gammes finales)
    { name: "Poco F4", price: 245000, rating: 4.2, brand: "Poco", image: "https://i0.wp.com/www.androidpure.com/wp-content/uploads/2023/02/Whats-new-in-the-Poco-F4-Android-13-update.jpg?fit=541%2C495&ssl=1" },
    { name: "ZTE Nubia Neo", price: 95000, rating: 4.0, brand: "ZTE", image: "https://tse3.mm.bing.net/th/id/OIP.sBcZ-xnM6n1FIqYIWcqCnwHaHa?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "CAT S53", price: 280000, rating: 4.1, brand: "CAT", image: "https://asset.conrad.com/media10/isa/160267/c1/-/en/002618732PI00/image.jpg" },
    { name: "Hisense E50 Lite", price: 65000, rating: 3.8, brand: "Hisense", image: "https://global.hisense.com/dam/jcr:864eddb6-b5ee-4756-b917-7691be76d0d0/m_banner_3@2x.jpg" },
    { name: "Sony Xperia XA2", price: 125000, rating: 3.5, brand: "Sony", image: "https://th.bing.com/th/id/OIP.yEWGtkIQrzogna0_M6ViOQAAAA?o=7&cb=12rm=3&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Blackberry Evolve", price: 115000, rating: 3.4, brand: "Blackberry", image: "https://tse3.mm.bing.net/th/id/OIP.fjtc6X5ZdYr5i4tYxEiCxwHaHa?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "HTC U Ultra", price: 125000, rating: 3.7, brand: "HTC", image: "https://www.droid-life.com/wp-content/uploads/2017/01/htc-u-ultra-pink-980x612.jpg" },
    { name: "TCL 501", price: 78000, rating: 3.7, brand: "TCL", image: "https://tse1.mm.bing.net/th/id/OIP.P8GPUjuLrFXuIUXarffg5wHaHa?cb=12&w=600&h=600&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Sony Xperia L4", price: 145000, rating: 3.7, brand: "Sony", image: "https://tse2.mm.bing.net/th/id/OIP.NbWOaEMEb5CmpBw29dHf5QHaHa?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "LG Q51", price: 95000, rating: 3.7, brand: "LG", image: "https://tse3.mm.bing.net/th/id/OIP.GwGTWy_wvaB2GYKXT2i9_gHaEU?cb=12&w=980&h=572&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "Microsoft Lumia 950 XL", price: 85000, rating: 3.2, brand: "Microsoft", image: "https://tse4.mm.bing.net/th/id/OIP.Ynygmq5PC7pHwHaJWAkCDAHaID?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3" },
    { name: "HTC Desire 10 Pro", price: 78000, rating: 3.6, brand: "HTC", image: "https://static1.pocketlintimages.com/wordpress/wp-content/uploads/138797-phones-news-feature-htc-desire-10-release-date-specs-and-everything-you-need-to-know-image1-rAgIdVBkKC.jpg" },
    { name: "Haier Phone i70", price: 65000, rating: 3.3, brand: "Haier", image: "https://images.frandroid.com/wp-content/uploads/2019/04/haier-haierphone-i70.png" }

]

const pagination1 = {
    currentPage: 1,
    gridID: "grid1",
    paginID: "pagin1",
    titleID: "title1"
}

const pagination2 = {
    currentPage: 1,
    gridID: "grid2",
    paginID: "pagin2",
    titleID: "title2"
}

const pagination3 = {
    currentPage: 1,
    gridID: "grid3",
    paginID: "pagin3",
    titleID: "title3"
}

const productsPerPage = 12;
let totalPages = 8;

let filteredProducts = allProducts;

document.addEventListener('DOMContentLoaded', () => {
    const filterDropdownLinks = document.querySelectorAll('.product-filters-bar .filter-options-list a');
    const allFiltersButton = document.querySelector('.filter-all-button');
    const filterNone = document.getElementById('none');

    let activeFilters = {
        price: null,
        brand: null,
        rating: null
    };

    const applyFilters = () => {
        let matchingProducts = [];

        allProducts.forEach(product => {
            let matches = true;

            const brand = product.brand.toLowerCase();
            const price = product.price;
            const rating = product.rating;

            if (activeFilters.brand) {
                const filterBrandNormalized = activeFilters.brand.toLowerCase();
                if (!brand.includes(filterBrandNormalized)) {
                    matches = false;
                }
            }

            if (matches && activeFilters.price) {
                const [minStr, maxStr] = activeFilters.price.split('-');
                const minPrice = parseFloat(minStr);
                const maxPrice = maxStr === '+' ? Infinity : parseFloat(maxStr);

                if (price < minPrice || price > maxPrice) {
                    matches = false;
                }
            }

            if (matches && activeFilters.rating) {
                const minRating = parseFloat(activeFilters.rating);
                let lowerBound, upperBound;

                if (minRating === 5) {
                    lowerBound = 4.75;
                    upperBound = 5.1;
                } else if (minRating === 4.5) {
                    lowerBound = 4.25;
                    upperBound = 4.75;
                } else {
                    lowerBound = minRating;
                    upperBound = minRating + 0.5;
                }

                if (rating < lowerBound || rating >= upperBound) {
                    matches = false;
                }
            }

            if (matches) {
                matchingProducts.push(product);
            }
        });

        filteredProducts = matchingProducts;
        totalPages = Math.ceil(filteredProducts.length/productsPerPage);

        pagination1.currentPage = 1;
        pagination2.currentPage = 1;
        pagination3.currentPage = 1;

        updateDisplay(pagination1);
        updateDisplay(pagination2);
        updateDisplay(pagination3);
    };

    const resetFilters = () => {
        activeFilters = { price: null, brand: null, rating: null };

        filteredProducts = allProducts;
        totalPages = 8;

        pagination1.currentPage = 1;
        pagination2.currentPage = 1;
        pagination3.currentPage = 1;

        updateDisplay(pagination1);
        updateDisplay(pagination2);
        updateDisplay(pagination3);

        filterNone.checked = true;
    };

    filterDropdownLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const dataAttributes = e.currentTarget.dataset;
            activeFilters.price = dataAttributes.price || null;
            activeFilters.brand = dataAttributes.brand || null;
            activeFilters.rating = dataAttributes.rating || null;
            applyFilters();
            filterNone.checked = true;
        });
    });

    allFiltersButton.addEventListener('click', () => {
        resetFilters();
    });
});

// Afficher les produits
function displayProducts(pagination) {
    const grid = document.getElementById(pagination.gridID);
    if (grid===null) return;

    const startIndex = (pagination.currentPage - 1) * productsPerPage;
    const endIndex = Math.min(startIndex + productsPerPage, filteredProducts.length);
    const products = filteredProducts.slice(startIndex, endIndex);
    //On vide la grille pour la remplir à nouveau
    grid.innerHTML = '';

    products.forEach((product, index) => {
        const card = document.createElement('div');
        card.className = 'product-card';
        card.style.animationDelay = `${index * 0.12}s`;

        //Calcul automatique de nombre d'étoiles entières, demies et vides
        let n = (product.rating - Math.floor(product.rating))*10;
        let a = 0;
        let b = 0;
        let c = 0;
        if (n<4) {
            a = Math.floor(product.rating);
            b = 0;
            c = 5-a;
        } else if (n<7) {
            a = Math.floor(product.rating);
            b = 1;
            c = 5-a-b;
        } else {
            a = Math.ceil(product.rating);
            b = 0;
            c = 5-a-b;
        }

        card.innerHTML = `
          <div class="product-frame">
               <img src=${product.image}  alt=${product.brand} class="product-image">
          </div>
          <div class="product-title">${product.name}</div>
          <div class="product-rating">${'<i class="fa-solid fa-star"></i>'.repeat(a)}${'<i class="fa-solid fa-star-half-stroke"></i>'.repeat(b)}${'<i class="fa-regular fa-star"></i>'.repeat(c)}(${product.rating})</div>
          <div class="price-cart">
			  <div class="product-price">${product.price} FCFA</div>
			  <button class="btn-outline"><i class="fas fa-shopping-cart icon-margin"></i></button>
          </div>
        `;

        grid.appendChild(card);
    });

    if (typeof attachNavigationEvents === 'function') {
        attachNavigationEvents()
    }

}

// Générer la pagination intelligente
function renderPagination(pagination) {
    const pagin = document.getElementById(pagination.paginID);
    if (pagin===null) return;

    const currentPage = pagination.currentPage;
    //On vide la pagination pour le reremplir
    pagin.innerHTML = '';

    // Bouton Previous
    const prevBtn = document.createElement('button');
    prevBtn.textContent = 'Previous';
    prevBtn.className = 'page-btn';
    prevBtn.disabled = currentPage === 1;
    prevBtn.onclick = () => goToPage(currentPage - 1, pagination);
    pagin.appendChild(prevBtn);

    // Logique d'affichage des numéros
    const pagesToShow = [];

    if (totalPages >= 7) {
        if (currentPage <= 3) {
            // Au début: 1 2 3 4 ... 8
            pagesToShow.push(1, 2, 3, 4, '...', totalPages);
        } else if (currentPage >= totalPages - 2) {
            // À la fin: 1 ... 5 6 7 8
            pagesToShow.push(1, 2, '...', totalPages - 3, totalPages - 2, totalPages - 1, totalPages);
        } else {
            // Au milieu: 1 ... 4 5 6 ... 8
            pagesToShow.push(1, '...', currentPage - 1, currentPage, currentPage + 1, '...', totalPages);
        }
    } else {
        for (let i=1; i<=totalPages; i++) {
            pagesToShow.push(i);
        }
    }

    // Créer les boutons de pagination
    pagesToShow.forEach(page => {
        const btn = document.createElement('button');

        btn.className = 'page-num';
        btn.textContent = page;
        if (page === '...') {
            btn.disabled = true;
        } else {
            if (page === currentPage) {
                btn.className = 'page-num-active';
            }
            btn.onclick = () => goToPage(page, pagination);
        }

        pagin.appendChild(btn);
    });

    // Bouton Next
    const nextBtn = document.createElement('button');
    nextBtn.textContent = 'Next';
    nextBtn.className = 'page-btn';
    nextBtn.disabled = currentPage === totalPages;
    nextBtn.onclick = () => goToPage(currentPage + 1, pagination);
    pagin.appendChild(nextBtn);
}

function updateDisplay(pagination) {
    displayProducts(pagination);
    renderPagination(pagination);
}

// Aller à une page
function goToPage(page, pagination) {
    if (page < 1 || page > totalPages) return;
    pagination.currentPage = page;
    updateDisplay(pagination)
    // Scroll en haut de la grille
    const title = document.getElementById(pagination.titleID);
    title.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

// Initialisation
updateDisplay(pagination1);
updateDisplay(pagination2);
updateDisplay(pagination3);
