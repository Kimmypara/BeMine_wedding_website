# Create Wedding Plan Task

Create a new Wedding Plan Task for the couple.  

## Request Body

```json
{
    "wedding_plan_id": "19",
    "category_id": "1",
    "task_id":"4",
    "is_selected": "1",
    "is_completed": "0"
}
```

## Request 

<span class="box1">POST</span>
<span class="endpoint-box1">/wedding_plan_task/create.php</span>

### Body <span class="json">application/json</span>

<span class="box">wedding_plan_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The wedding_plan_id must be existing. 

<span class="box">category_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The category_id must be existing. 

<span class="box">task_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The task_id must be existing.

<span class="box">is_selected</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

Determines whether the wedding task is selected. Is Selected must be:
```
0 = Inactive
1 = Active
```

<span class="box">is_completed</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

Determines whether the wedding task is completed. Is Completed must be:
```
0 = Inactive
1 = Active
```

## Responses

### <span class="json">201 Created</span>

The request worked, so a new Wedding Plan Task was created.

```json
{
    "message": "Wedding Plan Task created."
}
```

---

### <span class="json">400 Bad Request</span>

The request has missing or invalid input.

```json
{
    "message": "Wedding Plan Task not created. Missing or invalid input."
}
```

Possible validation errors:

```json
{
    "message": "is_selected must be either 0 or 1."
}
```

```json
{
    "message": "is_completed must be either 0 or 1."
}
```
---

### <span class="json">404 Not Found</span>

The Wedding Plan Task does not exists.

```json
{
    "message": "Wedding Plan Id not found."
}
```
Possible validation errors:

```json
{
    "message": "Category Id not found."
}
```

```json
{
    "message": "Task not found."
}
```

### <span class="json">409 Conflict</span>

The Wedding Plan Task already exists.

```json
{
    "message": "This task already exists for this category in the wedding plan."
}
```

---

### <span class="json">500 Server Error</span>

The server failed to create the Wedding Plan.

```json
{
    "message": "Server error."
}
``` 