# Create Task

Create a new Task.  

## Request Body

```json
{
    "category_id":"8",
    "task_name":"quotation"
}
```

## Request 

<span class="box1">POST</span>
<span class="endpoint-box1">/task/create.phphp</span>

### Body <span class="json">application/json</span>

<span class="box">category_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The category_id must be existing.

<span class="box">task_name</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

The task name must be unique. 


## Responses

### <span class="json">201 Created</span>

The request worked, so a new Task was created.

```json
{
    "message": "Task created."
}
```

---

### <span class="json">400 Bad Request</span>

The request has missing or invalid input.

```json
{
    "message": "Task not created. Missing or invalid input."
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

Only administrators can create tasks.

```json
{
    "message": "Access denied. Admin only."
}
```

---

### <span class="json">409 Conflict</span>

The Task already exists.

```json
{
    "message": "Task not created. Task already exists."
}
```

---

### <span class="json">500 Server Error</span>

The server failed to create the Task.

```json
{
    "message": "Server error."
}
``` 