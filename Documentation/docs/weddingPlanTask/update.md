# Update Wedding Plan Task

Update Wedding Plan Task for the couple.

## Request Body

```json
{
    "wedding_plan_task_id": "306",
    "wedding_plan_id": "6",
    "task_id":"3",
    "is_selected": "1",
    "is_completed": "0",
    "category_id": "4"
}
```

## Request 

<span class="box1">PATCH</span>
<span class="endpoint-box1">/wedding_plan_task/update.php</span>

### Body <span class="json">application/json</span>

<span class="box">wedding_plan_task_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The wedding_plan_task_id must be existing. 

<span class="box">wedding_plan_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The wedding_plan_id must be existing.

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

<span class="box">category_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The category_id must be existing.

---

## Responses

### <span class="json">200 OK Updated</span>

The request worked, so wedding plan task was updated.

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

### <span class="json">404 Not Found</span>

The Wedding Plan Task does not exists.

```json
{
    "message": "Wedding Plan Task not found."
}
```

Possible validation errors:

```json
{
    "message": "Wedding Plan Id not found."
}
```

```json
{
    "message": "Task Id not found."
}
```

```json
{
    "message": "Category Id not found."
}
```

---


### <span class="json">500 Server Error</span>

The server failed to update the wedding plan task.

```json
{
    "message": "Server error."
}
``` 