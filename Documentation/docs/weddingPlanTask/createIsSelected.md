# Create Selected Categories List in Wedding Plan Task

Create a Selected Categories List in Wedding Plan Task for the couple.  

## Request Body

```json
{
  "wedding_plan_id": "19",
  "categories": ["26", "9", "10"]
}
```

## Request 

<span class="box1">POST</span>
<span class="endpoint-box1">/wedding_plan_task/createSelected.php</span>

### Body <span class="json">application/json</span>

<span class="box">wedding_plan_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The wedding_plan_id must be existing. 

<span class="box">categories</span>
<span class="endpoint-box">array</span>
<span class="endpoint-box">Required</span>

The categories field must contain one or more existing category IDs.  
Each category ID must already exist in the category table. 

```
This endpoint saves the selected categories for a couple’s wedding plan.
```

## Responses

### <span class="json">201 Created</span>

The request worked, so a Selected categories list is saved.

```json
{
    "message": "Selected categories saved."
}
```

---

### <span class="json">400 Bad Request</span>

The request has missing or invalid input.

```json
{
    "message": "Missing wedding_plan_id."
}
```

Possible validation errors:

```json
{
    "message": "Categories must be an array."
}
```

---

### <span class="json">404 Not Found</span>

The Wedding Plan ID does not exists.

```json
{
    "message": "Wedding Plan ID not found."
}
```


---

### <span class="json">500 Server Error</span>

The server failed to create the Selected Categories List.

```json
{
    "message": "Server error."
}
``` 