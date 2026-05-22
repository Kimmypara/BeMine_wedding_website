# Create Category 

Create a new Category.  

## Request Body

```json
{
    "category_name":"Drone Videography",
    "slug":"drone_videography"
}
```

## Request 

<span class="box1">POST</span>
<span class="endpoint-box1">/category/create.php</span>

### Body <span class="json">application/json</span>

<span class="box">category_name</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

Category Name have to be unique. 

<span class="box">slug</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

The slug must be unique and usually matches the category name in URL-friendly format.

## Responses

### <span class="json">201 Created</span>

The request worked, so a new Category was created.

```json
{
    "message": "Category created."
}
```

---

### <span class="json">400 Bad Request</span>

The request has missing or invalid input.

```json
{
    "message": "Category not created. Missing or invalid input."
}
```

---

### <span class="json">409 Conflict</span>

The Category already exists.

``````json
{
    "message": "Category not created. Category already exists."
}
```

---

### <span class="json">500 Server Error</span>

The server failed to create the Category.

```json
{
    "message": "Server error."
}
``` 