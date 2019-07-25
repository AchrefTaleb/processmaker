---
description: Add and configure Task elements in your Process model.
---

# Add and Configure Task Elements

## Add a Task Element

{% hint style="info" %}
### Don't Know What a Task Element Is?

See [Process Modeling Element Descriptions](process-modeling-element-descriptions.md) for a description of the [Task](process-modeling-element-descriptions.md#user-task) element.

### Permissions Required

Your user account or group membership must have the following permissions to add a Task element to the Process model:

* Processes: View Processes
* Processes: Edit Processes

See the [Process](../../../processmaker-administration/permission-descriptions-for-users-and-groups.md#processes) permissions or ask your ProcessMaker Administrator for assistance.
{% endhint %}

Follow these steps to add a Task element to the Process model:

1. [View your Processes](https://processmaker.gitbook.io/processmaker-4-community/-LPblkrcFWowWJ6HZdhC/~/drafts/-LRhVZm0ddxDcGGdN5ZN/primary/designing-processes/viewing-processes/view-the-list-of-processes/view-your-processes#view-all-processes). The **Processes** page displays.
2. [Create a new Process](../../viewing-processes/view-the-list-of-processes/create-a-process.md) or click the **Open Modeler** icon![](../../../.gitbook/assets/open-modeler-edit-icon-processes-page-processes.png)to edit the selected Process model. Process Modeler displays.
3. Locate the **Task** element in the panel to the left of the Process Modeler canvas.

   ![](../../../.gitbook/assets/task-bpmn-side-bar-process-modeler-processes.png)

4. Drag the element into the Process model canvas where you want to place it. If a Pool element is in your Process model, the Task element cannot be placed outside of the Pool element.

![Task element](../../../.gitbook/assets/task-element-process-modeler-processes.png)

After the element is placed into the Process model, you may move it by dragging it to the new location.

{% hint style="warning" %}
Moving a Task element has the following limitations in regards to the following Process model elements:

* **Pool element:** If the Task element is inside of a [Pool](process-modeling-element-descriptions.md#pool) element, it cannot be moved outside of the Pool element. If you attempt to do so, Process Modeler places the Task element inside the Pool element closest to where you attempted to move it.
* **Lane element:** If the Task element is inside of a Lane element, it can be moved to another Lane element in the same Pool element. However, the Task element cannot be moved outside of the Pool element.
{% endhint %}

## Configure a Task Element

{% hint style="info" %}
Your user account or group membership must have the following permissions to configure a Task element:

* Processes: View Processes
* Processes: Edit Processes

See the [Process](../../../processmaker-administration/permission-descriptions-for-users-and-groups.md#processes) permissions or ask your ProcessMaker Administrator for assistance.
{% endhint %}

### Edit the Identifier Value

Process Modeler automatically assigns a unique value to each Process element added to a Process model. However, an element's identifier value can be changed if it is unique to all other elements in the Process model, including the Process model's identifier value.

{% hint style="warning" %}
All identifier values for all elements in the Process model must be unique.
{% endhint %}

Follow these steps to edit the identifier value for a Task element:

1. Select the Task element from the Process model in which to edit its identifier value. The **Configuration** setting section displays.
2. Expand the **Configuration** setting section if it is not presently expanded. The **Identifier** field displays. This is a required field.  

   ![](../../../.gitbook/assets/task-configuration-identifier-name-process-modeler-processes.png)

3. In the **Identifier** field, edit the Task element's identifier to a unique value from all elements in the Process model and then press **Enter**. The element's identifier value is changed.

### Edit the Element Name

An element name is a human-readable reference for a Process element. Process Modeler automatically assigns the name of a Process element with its element type. However, an element's name can be changed.

Follow these steps to edit the name for a Task element:

1. Select the Task element from the Process model in which to edit its name. The **Configuration** setting section displays.
2. Expand the **Configuration** setting section if it is not presently expanded. The **Name** field displays.  

   ![](../../../.gitbook/assets/task-configuration-name-process-modeler-processes.png)

3. In the **Name** field, edit the selected element's name and then press **Enter**. The element's name is changed.

### Select the ProcessMaker Screen for a Task Element

Since Task elements are designed to collect or display [Request](../../../using-processmaker/requests/what-is-a-request.md) information, specify which [ProcessMaker Screen](../../design-forms/what-is-a-form.md) a selected Task element uses. A ProcessMaker Screen must already exist before it can be selected for use in a Task element.

{% hint style="warning" %}
Ensure to select a ProcessMaker Screen for each Task element in your Process model. If a ProcessMaker Screen is not specified and Requests are started for that Process, users who are assigned Tasks with no ProcessMaker Screens have no way of interacting with the Task.
{% endhint %}

Follow these steps to select a ProcessMaker Screen for a Task element:

1. Select the Task element from the Process model in which to specify its ProcessMaker Screen. The **Configuration** setting section displays.
2. Expand the **Configuration** setting section if it is not presently expanded, and then scroll to the **Screen For Input** drop-down menu.  

   ![](../../../.gitbook/assets/screen-input-task-process-modeler-processes.png)

3. From the **Screen For Input** drop-down menu, select which ProcessMaker Screen that Task element references. This drop-down menu displays only [Form](../../design-forms/screens-builder/types-for-screens.md#form) types so the Task assignee can interact with information in the ProcessMaker Screen. Note that another Task element located elsewhere in the Process model may reference a different ProcessMaker Screen to display a different Task when it triggers.

{% hint style="warning" %}
If no ProcessMaker Screens exist, the **Screen For Input** drop-down menu contains no options. Ensure to select a ProcessMaker Screen for every Task element in the Process model before deploying your Process.
{% endhint %}

### Specify When the Task is Due

Specify when a [Task](../../../using-processmaker/task-management/what-is-a-task.md) in a Task element is due from when that task is assigned to a Request participant.

The task due date displays for each [pending assigned Task](../../../using-processmaker/requests/view-completed-requests.md#view-completed-requests-in-which-you-are-a-participant). After the specified time has expired for a task, an overdue indicator displays for that task to the assigned task recipient.

{% hint style="info" %}
Specify due time for a Task element in total number of hours. This includes hours not normally associated with business hours, including overnight hours, weekends, and holidays.
{% endhint %}

When a Task element is placed into a Process model, the default period of time for a task to be due is 72 hours \(three days\).

Follow these steps to specify when a Task element is due:

1. Select the Task element from the Process model in which to specify how many hours the task is due. The **Configuration** setting section displays.
2. Expand the **Configuration** setting section if it is not presently expanded, and then scroll to the **Due In** field.  

   ![](../../../.gitbook/assets/due-task-process-modeler-processes.png)

3. In the **Due In** field, specify the total number of hours the task is due in one of the following ways:
   * Enter the number in the **Due In** field and then press **Enter**. The number of hours is entered.
   * Hover your cursor over the **Due In** field, and then use the spin arrows to increase or decrease the total number of hours by one.

### Select to Whom to Assign the Task

Select to whom to assign the Task that is referenced in a Task element:

* **Requester:** Assign that Task to the person who started the Request, also known as the requester.
* **User:** Assign that Task to a specified ProcessMaker user.
* **Group:** Assign that Task to any member of a specified ProcessMaker group. When a Task is assigned to a ProcessMaker group, round robin assignment rules determine which group member is the assignee without manually assigning the Task.
* **Previous Task assignee:** Assign that Task to the previous Task assignee in that Request's workflow.

Follow these steps to select to whom to assign the Task that is referenced in a Task element:

1. Select the Task element from the Process model in which to select the Task assignee. The **Configuration** setting section displays.
2. Expand the **Configuration** setting section if it is not presently expanded, and then scroll to the **Task Assignment** drop-down menu.  

   ![](../../../.gitbook/assets/assignment-assignee-task-process-modeler-processes.png)

3. From the **Task Assignment** drop-down menu, select one of the following options:
   * **Requester:** Select **Requester** to assign the Task to the requester.
   * **User:** Select **User** to assign the Task to a specified ProcessMaker user. When this option is selected, the **Assigned User** drop-down menu displays below the **Task Assignment** drop-down menu.  

     ![](../../../.gitbook/assets/assignment-assignee-user-task-process-modeler-processes.png)

     From the **Assigned User** drop-down menu, select the person's full name as the Task element's assignee.

   * **Group:** Select **Group** to assign the Task to a specified ProcessMaker group. When this option is selected, the **Assigned Group** drop-down menu displays below the **Task Assignment** drop-down menu.  

     ![](../../../.gitbook/assets/assignment-assignee-group-task-process-modeler-processes.png)

     From the **Assigned Group** drop-down menu, select the group as the Task assignee.

   * **Previous Task Assignee:** Select **Previous Task Assignee** to assign the Task to who was assigned the Task in the preceding Task element.
4. Select the **Allow Reassignment** checkbox to allow the Task assignee to reassign the Task if necessary. If the **Allow Reassignment** checkbox is selected, the **Reassign** button displays in the Task summary to allow that Task assignee to reassign that Task. See [View a Task Summary](../../../using-processmaker/task-management/view-a-task-summary.md#summary).

### Assign the Task Using a Rule

Instead of [selecting to whom to assign a Task](add-and-configure-task-elements.md#select-to-whom-to-assign-the-task) that is referenced in a Task element, assign the Task's assignee using a rule:

* **Requester:** Assign that Task to the person who started the Request, also known as the requester.
* **User:** Assign that Task to a selected ProcessMaker user.
* **Group:** Assign that Task to a selected ProcessMaker group. When a Task is assigned to a ProcessMaker group, round robin assignment rules determine which group member is the assignee without manually assigning the Task.

The rule that determines the Task assignee uses an expression syntax described in [Expression Syntax Components](add-and-configure-task-elements.md#expression-syntax-components). Each rule can only have one expression, but by using logical operators multiple conditions can be specified in that expression.

Follow these steps to select to whom to assign the Task that is referenced in a Task element using a rule:

1. Select the Task element from the Process model in which to assign the Task via a rule. The **Configuration** setting section displays.
2. Expand the **Configuration** setting section if it is not presently expanded, and then scroll to the **Assign by Expression** option.
3. From the **Assign by Expression** option, click the **+Rule** button.  

   ![](../../../.gitbook/assets/rule-assignment-assignee-task-process-modeler-processes.png)

   The **Expression** and **Task Assignment** fields display.  

   ![](../../../.gitbook/assets/rule-expression-assignment-assignee-task-process-modeler-processes.png)

4. In the **Expression** field, enter or edit the expression that determines that Task element's Task assignee using the syntax components described in [Expression Syntax Components](add-and-configure-task-elements.md#expression-syntax-components), and then press **Enter**.
5. From the **Task Assignment** drop-down menu, select that Task's assignee from the following options:
   * **Requester:** Select the **Requester** option to assign that Task element's Task to the requester if the expression in the **Expression** field evaluates as True.
   * **User:** Select the **User** option to assign that Task element's Task to a ProcessMaker user if the expression in the **Expression** field evaluates as True. When the **User** option is selected, the **Assigned User** drop-down menu displays below the **Task Assignment** option.  

     ![](../../../.gitbook/assets/rule-expression-user-assignment-assignee-task-process-modeler-processes.png)

     From the **Assigned User** drop-down menu, select which ProcessMaker user to assign that Task.

   * **Group:** Select the **Group** option to assign that Task element's Task to a ProcessMaker group if the expression in the **Expression** field evaluates as True. When the **Group** option is selected, the **Assigned Group** drop-down menu displays below the **Task Assignment** option.  

     ![](../../../.gitbook/assets/rule-expression-group-assignment-assignee-task-process-modeler-processes.png)

     From the **Assigned Group** drop-down menu, select which ProcessMaker group to assign that Task.
6. Click **Save**.

#### Expression Syntax Components

Use the following expression syntax components to compose the expression that describes to whom is assigned a Task referenced in a Task element.

**Literals**

| Component | Syntax | Example |
| :--- | :--- | :--- |
| string | `"hello world"` or `'hello world'` |  |
| number | `100` |  |
| array | `[`value1`,` value2`]` | `[1, 2]` |
| hash | `{foo: "`value`"}` | `{foo: "bar"}` |
| Boolean | `true` and `false` |  |

**Arithmetic Operations**

| Component | Syntax |
| :--- | :--- |
| addition | `+` |
| subtraction | `-` |
| multiplication | `*` |
| division | `/` |

**Logical Operators**

| Component | Syntax |
| :--- | :--- |
| not | `not` |
| and | `and` |
| or | `or` |

**Comparison Operators**

| Component | Syntax |
| :--- | :--- |
| equal to | `==` |
| not equal to | `!=` |
| less than | `<` |
| greater than | `>` |
| less than or equal to | `<=` |
| greater than or equal to | `>=` |

**String Operator**

| Component | Syntax |
| :--- | :--- |
| concatenate matches | `~` |

**Array Operators**

| Component | Syntax |
| :--- | :--- |
| contains | `in` |
| does not contain | `not in` |

**Ternary**

| Component | Syntax | Example |
| :--- | :--- | :--- |
| ternary | tested value `?` if true then value `:` else then value | `foo ? bar : baz` |

**Range**

| Component | Syntax | Example |
| :--- | :--- | :--- |
| range | `..` | `foo in 1..10` |

### Set Task Notifications

Set when [notifications](../../../using-processmaker/notifications.md) regarding Tasks are sent to the following:

* **Requester:** Send notifications to the Request initiator \(referred to as the requester\) when the Task associated with this Task element is assigned and/or completed.
* **Task assignee:** Send notifications to Task assignees associated with this Task element when that Task is assigned and/or completed.
* **Request participants:** Send notifications to all Request participants of this Process when the Task associated with this Task element is assigned or completed.

Follow these steps to set Task notifications in a Task element:

1. Select the Task element from the Process model in which to set Task notifications. The **Configuration** setting section displays.
2. Expand the **Configuration** setting section if it is not presently expanded, and then scroll to the **Task Notifications** settings.  

   ![](../../../.gitbook/assets/notification-task-process-modeler-processes.png)

3. From the **Requester** settings, set Task notifications for the Requester following these guidelines:
   * Enable the **Assigned** setting to notify the Requester when the Task associated with this Task element is assigned. Otherwise, disable this setting to not send this notification.
   * Enable the **Completed** setting to notify the Requester when the Task associated with this Task element is completed. Otherwise, disable this setting to not send this notification.
   * Enable the **Due** setting to notify the Requester when the Task associated with this Task element is due to be completed. Otherwise, disable this setting to not send this notification.
4. From the **Assignee** settings, set Task notifications for assignees of this Task element following these guidelines:
   * Enable the **Assigned** setting to notify Task assignees associated with this Task element when they are assigned this Task. Otherwise, disable this setting to not send this notification.
   * Enable the **Completed** setting to notify Task assignees associated with this Task element when they complete this Task. Otherwise, disable this setting to not send this notification.
   * Enable the **Due** setting to notify Task assignees associated with this Task element is due to be completed. Otherwise, disable this setting to not send this notification.
5. From the **Participants** settings, set Task notifications to all Request participants of this Process following these guidelines:
   * Enable the **Assigned** setting to notify all Request participants of this Process when the Task associated with this Task element is assigned. Otherwise, disable this setting to not send this notification.
   * Enable the **Completed** setting to notify all Request participants of this Process when the Task associated with this Task element is completed. Otherwise, disable this setting to not send this notification.
   * Enable the **Due** setting to notify all Request participants of this Process when the Task associated with this Task element is due to be completed. Otherwise, disable this setting to not send this notification.

### Select to Whom to Assign the Task via a Web Entry

{% hint style="info" %}
Your ProcessMaker instance must have the [Web Entry package](../../../package-development-distribution/package-a-connector/web-entry.md) installed to select to whom to assign a Task via a Web entry. The Web Entry package allows anonymous or authenticated ProcessMaker users to start or participate in Requests via a published URL. The Web Entry package is not available in the ProcessMaker open-source edition.

The Web Entry package is not available in the ProcessMaker open-source edition. Contact [ProcessMaker Sales](mailto:sales@processmaker.com) or ask your ProcessMaker sales representative how the Web Entry package can be installed in your ProcessMaker instance.
{% endhint %}

When a Task element is placed into a Process model, Web Entry settings for that element are not configured. Therefore, even if the [Web Entry](../../../package-development-distribution/package-a-connector/web-entry.md) package is installed in your ProcessMaker instance, it must be configured for use.

Follow these steps to select to whom to assign the Task via a Web Entry:

1. Select the Task element from the Process model in which to select to whom to assign the Task via a Web Entry. The **Configuration** setting section displays.
2. From the Web Entry setting, click one of the following options:
   * **Disabled:** Select the **Disabled** option to disable the Web Entry package from assigning this Task element via a Web Entry.
   * **Anonymous:** Select the **Anonymous** option to assign the Task to any person who has access to the Web Entry's URL. This person may not be a ProcessMaker user.  

     ![](../../../.gitbook/assets/web-entry-anonymous-task-process-modeler-processes.png)

   * **Authenticated:** Select the **Authenticated** option to assign the Task to an authenticated ProcessMaker user or group member via the Web Entry's URL.  

     ![](../../../.gitbook/assets/web-entry-authenticated-task-process-modeler-processes.png)

     Select whether to assign a ProcessMaker user or group member the Task via the Web Entry's URL. To do so, follow these guidelines:

     **ProcessMaker User**

     1. From the **Web Entry Start Permission** drop-down menu, select the **User** option. The **User** drop-down menu displays below the **Web Entry Start Permission** drop-down menu.  

        ![](../../../.gitbook/assets/web-entry-authenticated-mode-user-start-event-process-modeler-processes.png)

     2. From the **User** drop-down menu, select which ProcessMaker user to assign the Task via the Web Entry's URL.

     **ProcessMaker Group**

     1. From the **Web Entry Start Permission** drop-down menu, select the **Group** option. The **Group** drop-down menu displays below the **Web Entry Start Permission** drop-down menu.  

        ![](../../../.gitbook/assets/web-entry-authenticated-mode-group-start-event-process-modeler-processes.png)

     2. From the **Group** drop-down menu, select which ProcessMaker group to assign the Task via the Web Entry's URL. Any member of that ProcessMaker group may be assigned the Task via the Web Entry's URL.
3. From the **Completed Action** drop-down menu, select one of the following options:
   * **Screen:** Select the **Screen** option to indicate that a ProcessMaker Screen displays after the Task assignee submits the Task. **Screen** is the default setting. ![](../../../.gitbook/assets/web-entry-completed-action-screen-start-event-process-modeler-processes.png) 

     After the **Screen** option is selected, the **Screen For Completed** drop-down menu displays below the **Completed Action** drop-down menu. From the **Screen For Completed** drop-down menu, select the ProcessMaker Screen that displays after the Task assignee submits the Task. This drop-down menu displays only [Display](../../design-forms/screens-builder/types-for-screens.md#display) types to display a message to the Task assignee. This is a required field.

     ![](../../../.gitbook/assets/web-entry-screen-completed-start-event-process-modeler-processes.png) 

   * **Url:** Select the **Url** option to indicate that the Task assignee is redirected to a URL after the Task assignee submits the ProcessMaker Screen selected from the **Screen Associated** drop-down menu.  

     ![](../../../.gitbook/assets/web-entry-completed-action-url-start-event-process-modeler-processes.png)

     After the **Url** option is selected, the **Url to redirect to** field displays below the **Completed Action** drop-down menu. In the **Url to redirect to** field, enter the URL to redirect the Requester after the Task assignee submits the ProcessMaker Screen selected from the **Screen Associated** drop-down menu, and then press **Enter**. This is a required field.  

     ![](../../../.gitbook/assets/web-entry-url-start-event-process-modeler-processes.png)
4. The **Web Entry URL** displays the Web Entry URL from which the Task assignee accesses the ProcessMaker Screen selected from the **Screen Associated** drop-down menu. The **Web Entry URL** value cannot be changed. The Web Entry package generates this URL using the following structure: _`ProcessMaker instance domain`_`/webentry/`_`Web Entry numerical instance`_`/`_`Identifier Value of this Start Event element`_. If necessary, click the **Copy to clipboard** link to copy the **Web Entry URL** value so that it is available in your clipboard.  

   ![](../../../.gitbook/assets/web-entry-url-access-start-event-process-modeler-processes.png)

## Related Topics

{% page-ref page="process-modeling-element-descriptions.md" %}

{% page-ref page="../../viewing-processes/view-the-list-of-processes/view-your-processes.md" %}

{% page-ref page="../../viewing-processes/view-the-list-of-processes/create-a-process.md" %}

{% page-ref page="../../design-forms/what-is-a-form.md" %}

{% page-ref page="../../../using-processmaker/requests/what-is-a-request.md" %}

{% page-ref page="../../../using-processmaker/task-management/what-is-a-task.md" %}

{% page-ref page="../../../using-processmaker/task-management/view-tasks-you-need-to-do.md" %}

{% page-ref page="../../../using-processmaker/notifications.md" %}

{% page-ref page="../remove-process-model-elements.md" %}

{% page-ref page="../../../using-processmaker/task-management/view-a-task-summary.md" %}

