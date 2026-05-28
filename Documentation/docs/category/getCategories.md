# Get Categories 

Get a list of all Categories. 

## Request 

<span class="box1">GET</span>
<span class="endpoint-box1">/category/read.php</span>

---

## Description

This endpoint returns all Categories stored in the database.

---

## Response

### <span class="json">200 OK</span>

```json
{
    "data": [
        {
            "category_id": 27,
            "category_name": "Balloon Decorations",
            "slug": "balloon_decorations"
        },
        {
            "category_id": 19,
            "category_name": "Beverage Services",
            "slug": "beverage_services"
        },
        {
            "category_id": 9,
            "category_name": "Bridal Wear",
            "slug": "bridal_wear"
        }
    ]
}
```

---

### <span class="json">404 Not Found</span>

No Categories were found.

```json
{
    "message": "Categories not found."
}
```