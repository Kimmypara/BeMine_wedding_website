# Update Category  

Update Category. 

## Request Body

```json
{
    "category_id": "12",
    "category_name": "Live Bands",
    "slug": "live_bands"
}
```

## Request 

<span class="box1">PUT</span>
<span class="endpoint-box1">/category/update.php</span>

### Body <span class="json">application/json</span>

<span class="box">category_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The category_id must be existing. 

<span class="box">category_name</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

Name of category have to be unique.

<span class="box">slug</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

Ideally the Slug should be the same as the Name of category.


---

## Responses

### <span class="json">200 OK Updated</span>

The request worked, so category was updated.

```json
{
    "message": "Category updated."
}
```

---

### <span class="json">400 Bad Request</span>

The request has missing or invalid input.

```json
{
    "message": "Category not updated. Missing or invalid input."
}
```

---

### <span class="json">401 Unauthorized</span>

Unauthorized.

```json
{
    "message": "Unauthorized."
}
```

---

### <span class="json">403 Forbidden</span>

Only administrators can update categories.

```json
{
    "message": "Access denied. Admin only."
}
```

---

### <span class="json">409 Conflict</span>

The category already exists.

```json
{
    "message": "Category not updated. Category ID does not exists."
}
```
Possible validation errors:

```json
{
    "message": "Category not updated. Category Name already exists."
}
```

---

### <span class="json">500 Server Error</span>

The server failed to update the Category.

```json
{
    "message": "Server error."
}
``` 