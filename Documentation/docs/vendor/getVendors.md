# Get Vendors 

Get a list of all Vendors. 

## Request 

<span class="box1">GET</span>
<span class="endpoint-box1">/vendor/read.php</span>

---

## Description

This endpoint returns all Vendors stored in the database.

---

## Response

### <span class="json">200 OK</span>

```json
{
    "data": [
        {
            "vendor_id": 13,
            "vendor_name": "Dream Bouquet Co.",
            "category_id": 1,
            "user_id": 2,
            "locations": "Fgura",
            "basic_info": "Founded in 1969, Neriku Catering has garnered 50 years of experience in the catering industry, providing top quality service at affordable prices. Everything we do is done with passion and utmost dedication.",
            "min_price": "11000.00",
            "images": [
                "assets/vendor_images/dreamBouquet2.jpg",
                "assets/vendor_images/dreamBouquet1.jpg",
                "assets/vendor_images/dreamBouquet3.jpg"
            ]
        },
        {
            "vendor_id": 4,
            "vendor_name": "Eternal Lens Co.",
            "category_id": 8,
            "user_id": 2,
            "locations": "Mobile",
            "basic_info": "By 2017, some of my work was being noticed and I had a number of assignments. This necessitated serious investment in my gear to satisfy the range of work I was doing. In 2022, I switched all my camera bodies and lenses to a mirrorless system as I believe that, although yes, the photographer needs to be artist, technology is always improving and good tools help you achieve a better result. I am lucky enough to have had the opportunity of shooting different scenarios and subjects including weddin",
            "min_price": "1200.00",
            "images": [
                "assets/vendor_images/eternalLens3.jpg",
                "assets/vendor_images/eternalLens2.jpg",
                "assets/vendor_images/eternalLens1.jpg"
            ]
        },
        {
            "vendor_id": 14,
            "vendor_name": "EverAfter Dresses",
            "category_id": 9,
            "user_id": 11,
            "locations": "Fgura",
            "basic_info": "We believe every bride deserves to feel confident, beautiful, and unforgettable on her special day. Our bridal collection combines timeless elegance with modern design, offering carefully selected gowns for every wedding style.",
            "min_price": "400.00",
            "images": [
                "assets/vendor_images/EverAfterDresses2.jpg",
                "assets/vendor_images/EverAfterDresses1.jpg",
                "assets/vendor_images/EverAfterDresses3.jpg"
            ]
        },
        {
            "vendor_id": 5,
            "vendor_name": "Forever Flowers",
            "category_id": 1,
            "user_id": 3,
            "locations": "Qormi",
            "basic_info": "The company specializes in seasonal gifts and decorations, with a wide selection for Christmas and Valentine’s amongst the many special yearly occasions. Flower Land provides the best quality service on the island to some of Malta’s leading hotels and restaurants, high profile conferences and meetings, weddings, private occasions, funerals, hospitals.",
            "min_price": "800.00",
            "images": [
                "assets/vendor_images/foreverFlowers3.jpg",
                "assets/vendor_images/foreverFlowers2.jpg",
                "assets/vendor_images/foreverFlowers1.jpg"
            ]
        },
        {
            "vendor_id": 15,
            "vendor_name": "Golden Horizon Venue",
            "category_id": 7,
            "user_id": 11,
            "locations": "Mellieha",
            "basic_info": "We believe every love story deserves a beautiful setting. Our venue offers romantic gardens, elegant spaces, and personalised service to help create unforgettable wedding memories.",
            "min_price": "6000.00",
            "images": [
                "assets/vendor_images/GoldenHorizonVenue3.jpg",
                "assets/vendor_images/GoldenHorizonVenue2.jpg",
                "assets/vendor_images/GoldenHorizonVenue1.jpg"
            ]
        },
        {
            "vendor_id": 12,
            "vendor_name": "Golden Olive Catering",
            "category_id": 10,
            "user_id": 2,
            "locations": "Paola",
            "basic_info": "Founded in 1969, Neriku Catering has garnered 50 years of experience in the catering industry, providing top quality service at affordable prices. Everything we do is done with passion and utmost dedication.",
            "min_price": "12000.00",
            "images": [
                "assets/vendor_images/GoldenOlive1.jpg",
                "assets/vendor_images/GoldenOlive3.jpg",
                "assets/vendor_images/GoldenOlive2.jpg"
            ]
        },
        {
            "vendor_id": 11,
            "vendor_name": "Pearl Ink Designs",
            "category_id": 4,
            "user_id": 2,
            "locations": "Rabat",
            "basic_info": "We are a family business and we run different businesses/projects that complement each other in providing excellent customer service in every area that we operate in. Each project is focused on a particular service that we can provide to our customers. Stampatur.com is a design and printing service focused on delivering rapid design and printing services professionally at an affordable price. We take pride in our ability to understand our customers and come up with the right solutions.",
            "min_price": "400.00",
            "images": [
                "assets/vendor_images/pearlInk1.jpg",
                "assets/vendor_images/pearlInk3.jpg",
                "assets/vendor_images/pearlInk2.jpg"
            ]
        }
    ]
}
```

---

### <span class="json">404 Not Found</span>

No Vendors were found.

```json
{
    "message": "Vendors not found."
}
```