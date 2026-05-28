# Get Single Category 

Get a single category by category_id. 

## Request 

<span class="box1">GET</span>
<span class="endpoint-box1">/category/readSingle.php?category_id=1</span>

---

## Description

This endpoint returns a single category from the database using the provided category_id.

---

## Response

### <span class="json">200 OK</span>

```json
{
    "category_id": "1",
    "category_name": "Florists",
    "slug": "florists"
}
```

---
### <span class="json">400 Bad request</span>

The category_id is missing.

```json
{
    "message": "Missing category_id."
}
```
---
### <span class="json">404 Not Found</span>

No category was found with the provided category_id.

```json
{
    "message": "No Categories found."
}
```