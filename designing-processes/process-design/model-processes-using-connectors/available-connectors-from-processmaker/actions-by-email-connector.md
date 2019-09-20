---
description: Request participants can make decisions via email with the click of a button.
---

# Actions By Email Connector

## Overview

The Actions By Email connector is part of the [Actions By Email package](../../../../package-development-distribution/package-a-connector/actions-by-email-package.md). Use the Actions By Email connector in your Process models to automate emails to [Request](../../../../using-processmaker/requests/what-is-a-request.md) participants that allow them make decisions via email.

{% hint style="info" %}
### ProcessMaker Package Required

The Actions By Email connector requires that the [Actions By Email Email package](../../../../package-development-distribution/package-a-connector/actions-by-email-package.md) be installed in your ProcessMaker instance. The Actions By Email connector and the Actions By Email [package](../../../../package-development-distribution/first-topic.md) are not available in the ProcessMaker open-source edition. Contact [ProcessMaker Sales](mailto:sales@processmaker.com) or ask your ProcessMaker sales representative how the Actions By Email connector can be installed in your ProcessMaker instance.
{% endhint %}

When the Actions By Email connector triggers during an in-progress Request, ProcessMaker sends an email from the "no-reply@processmaker.net" email address to one email recipient so that this Request participant can make a decision as part of the Request. For example, this Request participant must make a decision to approve or deny a vacation request or for a purchase. The email recipient receives an email with buttons in the email to easily indicate the decision.

![Example email the Actions By Email connector sends to an email recipient](../../../../.gitbook/assets/actions-by-email-package.png)

After the email recipient clicks a button to indicate the decision, ProcessMaker receives the response and uses the indicated decision as part of the Request routing. For example, if you grant a leave request, the Request routes different than if you deny that leave request. 

The email recipient's name and email address can be specified in one of the following ways when configuring the Actions By Email connector:

* Plain text
* A **Variable Name** setting value using mustache syntax, for example `{{ email_recipient }}` and `{{ email_address }}`, respectively
* A [ProcessMaker Magic Variable](../../../reference-global-variables-in-your-processmaker-assets.md) value, specifically `{{ _user.fullname }}` and `{{ _user.email }}`, respectively

When an Actions By Email connector triggers during an in-progress Request, ProcessMaker automatically creates an asynchronous child Process: the Actions By Email connector sends the email \(the child Process\) while simultaneously the in-progress Request continues \(the parent Process\). In doing so, one of the following occurs:

* **An error occurs in the email delivery:** While attempting to send the email, the Actions By Email connector receives an error. For example, your organization's email server or the email recipient's email server may be down. The child Process receives and sends the error to the parent Process. The child Process ends. Reference the child Process's error from the in-progress Request.
* **The Actions by Email connector sends the email:** The email recipient receives the email while the in-progress Request continues \(the parent Process\). The child Process ends, but the email recipient may not have responded to the email. If the in-progress Request routes to an [Exclusive Gateway](../../model-your-process/process-modeling-element-descriptions.md#exclusive-gateway) element that requires the email recipient's response to evaluate routing, then the in-progress Request remains indefinitely active on the Exclusive Gateway element. To address this issue, design your Process model to use an [Event-Based Gateway](../../model-your-process/process-modeling-element-descriptions.md#event-based-gateway) element preceding the Exclusive Gateway element that checks the following: \(1\) if an [Intermediate Timer Event](../../model-your-process/process-modeling-element-descriptions.md#intermediate-timer-event) element triggers \(after 72 hours, for example\), the email recipient has not responded to the email; or \(2\) if an [Intermediate Message Catch Event](../../model-your-process/process-modeling-element-descriptions.md#intermediate-message-catch-event) element received the response from the email recipient.

## Add an Actions by Email Control to the Process Model

{% hint style="info" %}
### ProcessMaker Package Required

The [Actions By Email](../../../../package-development-distribution/package-a-connector/actions-by-email-package.md) package is required. The Actions By Email package installs the Actions By Email connector, which is not available in the ProcessMaker open-source edition. Contact [ProcessMaker Sales](mailto:sales@processmaker.com) or ask your ProcessMaker sales representative how the Actions By Email connector can be installed in your ProcessMaker instance.

### Permissions Required

Your ProcessMaker user account or group membership must have the following permissions to add a Send Email control to the Process model unless your user account has the **Make this user a Super Admin** setting selected:

* Processes: View Processes
* Processes: Edit Processes

See the [Process](../../../../processmaker-administration/permission-descriptions-for-users-and-groups.md#processes) permissions or ask your ProcessMaker Administrator for assistance.
{% endhint %}

Follow these steps to add a Send Email control to the Process model:

1. [View your Processes](https://processmaker.gitbook.io/processmaker-4-community/-LPblkrcFWowWJ6HZdhC/~/drafts/-LRhVZm0ddxDcGGdN5ZN/primary/designing-processes/viewing-processes/view-the-list-of-processes/view-your-processes#view-all-processes). The **Processes** page displays.
2. [Create a new Process](../../../viewing-processes/view-the-list-of-processes/create-a-process.md) or click the **Open Modeler** icon![](../../../../.gitbook/assets/open-modeler-edit-icon-processes-page-processes.png)to edit the selected Process model. Process Modeler displays.
3. Locate the **Send Email** control in the panel to the left of the Process Modeler canvas. ![](../../../../.gitbook/assets/send-email-control-connector-bpmn-process-modeler-processes.png) 
4. Drag the control into the Process model canvas where you want to place it. If a Pool element is in your Process model, the Send Email control cannot be placed outside of the Pool element.

![Send Email control](../../../../.gitbook/assets/send-email-control-connector-process-modeler-processes.png)

After the Send Email control is placed into the Process model, you may move it by dragging it to the new location.

{% hint style="warning" %}
Moving a Send Email control has the following limitations in regards to the following Process model elements:

* **Pool element:** If the Send Email control is inside of a [Pool](../../model-your-process/process-modeling-element-descriptions.md#pool) element, it cannot be moved outside of the Pool element. If you attempt to do so, Process Modeler places the Send Email control inside the Pool element closest to where you attempted to move it.
* **Lane element:** If the Send Email control is inside of a Lane element, it can be moved to another Lane element in the same Pool element. However, the Send Email control cannot be moved outside of the Pool element.
{% endhint %}

## Configure an Actions By Email Control

{% hint style="info" %}
### ProcessMaker Package Required

The Actions By Email package is required. The Actions By Email package installs the Actions By Email connector, which is not available in the ProcessMaker open-source edition. Contact [ProcessMaker Sales](mailto:sales@processmaker.com) or ask your ProcessMaker sales representative how the Actions By Email connector can be installed in your ProcessMaker instance.

### Permissions Required

Your ProcessMaker user account or group membership must have the following permissions to configure a Send Email control unless your user account has the **Make this user a Super Admin** setting selected:

* Processes: View Processes
* Processes: Edit Processes

See the [Process](../../../../processmaker-administration/permission-descriptions-for-users-and-groups.md#processes) permissions or ask your ProcessMaker Administrator for assistance.
{% endhint %}

Follow these steps to configure a Send Email control:

1. Select the Send Email control from the Process model in which to configure its settings. The **Send Email** configuration settings display. ![](../../../../.gitbook/assets/send-email-control-connector-configuration-process-modeler-processes.png)
2. In the **Email** field, enter the email address to which the Send Email control sends an email when this Send Email control triggers. The Email connector only supports sending an email to one email recipient. You may use the value from a [ProcessMaker Screen](../../../design-forms/what-is-a-form.md)'s **Key Name** setting as a variable in this field. For example, if your Process model references a ProcessMaker Screen that contains a [Lines Inputs control](../../../design-forms/screens-builder/control-descriptions/line-input-control-settings.md) with the **Key Name** setting value of `EmailAddress` that the Request participant enters an email address, use mustache syntax `{{EmailAddress}}` to use that Line Inputs control's value in the **Email** field.
3. In the **Name** field, enter the name of the email recipient. You may use the value from a ProcessMaker Screen's **Key Name** setting as a variable in this field. For example, if your Process model references a ProcessMaker Screen that contains a Lines Inputs control with the **Key Name** setting value of `FullName` that the Request participant enters an name, use mustache syntax `{{FullName}}` to use that Line Inputs control's value in the **Email** field.
4. In the **Subject** field, enter the subject of the email the Send Email control sends.
5. From the **Email body** drop-down menu, select which ProcessMaker Screen that Send Email control references. This drop-down menu displays only [Email](../../../design-forms/screens-builder/types-for-screens.md#email) types so the email recipient can read the body of the email. Note that another Send Email control located elsewhere in the Process model may reference a different ProcessMaker Screen to display a different email body when it triggers.

## Related Topics

{% page-ref page="../../../../package-development-distribution/package-a-connector/actions-by-email-package.md" %}

{% page-ref page="../what-is-a-connector.md" %}

{% page-ref page="../../../../package-development-distribution/first-topic.md" %}

