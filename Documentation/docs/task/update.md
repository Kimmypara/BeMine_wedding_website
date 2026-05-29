# Update Task  

Update Task. 

## Request Body

```json
{
    "task_id": "3",
    "category_id": "9",
    "task_name": "booking"
}
```

## Request 

<span class="box1">PATCH</span>
<span class="endpoint-box1">/task/update.php</span>

### Body <span class="json">application/json</span>

<span class="box">task_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The task_id must be existing. 

<span class="box">category_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The category_id must be existing. 

<span class="box">task_name</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

The task name must be unique. 


---

## Responses

### <span class="json">200 OK Updated</span>

The request worked, so Task was updated.

```json
{
    "message": "Task updated."
}
```

---

### <span class="json">400 Bad Request</span>

The request has missing or invalid input.

```json
{
    "message": "Task not updated. Missing or invalid input."
}
```

Possible validation errors:

```json
{
    "message": "Invalid category_id. Category does not exist."
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

Only administrators can update tasks.

```json
{
    "message": "Access denied. Admin only."
}
```

---

### <span class="json">409 Conflict</span>

The task already exists.

```json
{
    "message": "Task not updated. Task already exists."
}
```

---

### <span class="json">500 Server Error</span>

The server failed to update the Task.

```json
{
    "message": "Server error."
}
``` 