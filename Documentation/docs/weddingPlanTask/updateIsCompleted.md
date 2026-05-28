# Update If Task is Completed 

Update the wedding task if completed.

## Request Body

```json
{
    "wedding_plan_task_id": "65",
    "is_completed": "1",
    "completed_at": "NULL"
}
```

## Request 

<span class="box1">PATCH</span>
<span class="endpoint-box1">/wedding_plan_task/updateIsCompleted.php</span>

### Body <span class="json">application/json</span>

<span class="box">wedding_plan_task_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The wedding_plan_task_id must be existing.  

<span class="box">is_completed</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

Determines whether the wedding task is completed. Is Completed must be:
```
0 = Inactive
1 = Active
```

<span class="box">completed_at</span>
<span class="endpoint-box">datetime</span>
<span class="endpoint-box">Required</span>

The completed_at is automatically updated.
When is_completed is set to 1, the current date and time are saved.
When is_completed is set to 0, the value can be set back to NULL. 


## Responses

### <span class="json">200 OK Updated</span>

The request worked, so Wedding Plan Task was updated.

```json
{
    "message": "Wedding Plan Task updated."
}
```

---

### <span class="json">400 Bad Request</span>

The request has missing or invalid input.

```json
{
    "message": "Wedding Plan Task not updated. Missing or invalid input."
}
```

Possible Validation errors:

```json
{
    "message": "Invalid Is Completed value. Use 0 or 1 only."
}
```

### <span class="json">404 Not Found</span>

The wedding_plan_task_id is not found.

```json
{
    "message": "Wedding Plan Task Id not found."
}
```

---

### <span class="json">500 Server Error</span>

The server failed to update the user.

```json
{
    "message": "Server error."
}
``` 