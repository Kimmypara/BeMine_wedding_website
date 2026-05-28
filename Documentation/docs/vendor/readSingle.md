# Get Single Vendor 

Get a single vendor by vendor_id. 

## Request 

<span class="box1">GET</span>
<span class="endpoint-box1">/vendor/readSingle.php?vendor_id=4</span>

---

## Description

This endpoint returns a single vendor from the database using the provided vendor_id.

---

## Response

### <span class="json">200 OK</span>

```json
{
    "vendor_id": "4",
    "vendor_name": "Eternal Lens Co.",
    "category_id": 8,
    "user_id": 2,
    "locations": "Mobile",
    "basic_info": "By 2017, some of my work was being noticed and I had a number of assignments. This necessitated serious investment in my gear to satisfy the range of work I was doing. In 2022, I switched all my camera bodies and lenses to a mirrorless system as I believe that, although yes, the photographer needs to be artist, technology is always improving and good tools help you achieve a better result. I am lucky enough to have had the opportunity of shooting different scenarios and subjects including weddin",
    "min_price": "1200.00",
    "images": [
        "assets/vendor_images/eternalLens1.jpg",
        "assets/vendor_images/eternalLens2.jpg",
        "assets/vendor_images/eternalLens3.jpg"
    ]
}
```

---
### <span class="json">400 Bad request</span>

The vendor_id is missing.

```json
{
    "message": "Missing vendor Id."
}
```
---
### <span class="json">404 Not Found</span>

No vendor was found with the provided vendor_id.

```json
{
    "message": "Vendor not found."
}
```