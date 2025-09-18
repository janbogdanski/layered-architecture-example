## Notes and decisions:
- It was not specified if adding an invoice should be done together with lines. For simplicity, adding an invoice is independent from adding lines. This means more API calls are needed to add lines one by one. Without requirements and estimated load information, it's difficult to assess if this approach is optimal.
- The invoice view contains all fields from the main entities. This separation of view from entity ensures we won't need to worry when new fields are introduced but not intended to be exposed.
- I've added calculated fields — total price and total unit price — in entities and stored them in the database. Initially, I understood the "invoice structure" section as describing models. Later, I realized it was only a view structure requirement. I left the initial implementation untouched, but generally, it would be sufficient to calculate these values on the fly while rendering the view. Since this isn't a complex or time-consuming task, I would prefer not storing these in the database to avoid potential errors and reduce maintenance costs.
- UUIDs are exposed across the application. For a more robust solution, it would be better to hide them behind Value Objects — I left this as is for simplicity in this MVP.
- There is no error handling nor logging, only Assertions in the code to ensure it works correctly, expected types are used, and actions on specific objects are called properly.
- I ported this task to Symfony as I am fluent in this framework and didn't want to be limited by Laravel, which I know only a little bit.
- Regarding the requirement to "Change the Invoice Status to sending after sending the notification" — I would prefer to store the status first and then send the notification. I encountered a race condition in the past when the notification was sent asynchronously and processed faster than the status change :)
- The domain is tested in the Core module. One test for Application was added to showcase the approach for in-memory implementation. All other areas could follow a similar approach. I try to avoid built-in PHPUnit mocking as it can lead to code that's covered but not properly tested, in my opinion.
- The Notification component is left completely untouched as tests were included in the provided example.
- It was nice to see Api directory in Notification module, I did the same in my previous project where we tried to make old monolith modular without access to anything from anywhere. Using deptrac we ensured that only allowed namespaces could be used outside the module

## Setup
```
docker run --rm -it  --volume $PWD:/app composer install --ignore-platform-reqs --no-cache
docker compose up -d
docker compose exec app bin/console doctrine:migrations:migrate --no-interaction
```

## Endpoints:
See [endpoints.http](endpoints.http) file

___
## Invoice Structure:

The invoice should contain the following fields:
* **Invoice ID**: Auto-generated during creation.
* **Invoice Status**: Possible states include `draft,` `sending,` and `sent-to-client`.
* **Customer Name**
* **Customer Email**
* **Invoice Product Lines**, each with:
    * **Product Name**
    * **Quantity**: Integer, must be positive.
    * **Unit Price**: Integer, must be positive.
    * **Total Unit Price**: Calculated as Quantity x Unit Price.
* **Total Price**: Sum of all Total Unit Prices.

## Required Endpoints:

1. **View Invoice**: Retrieve invoice data in the format above.
2. **Create Invoice**: Initialize a new invoice.
3. **Send Invoice**: Handle the sending of an invoice.

## Functional Requirements:

### Invoice Criteria:

* An invoice can only be created in `draft` status.
* An invoice can be created with empty product lines.
* An invoice can only be sent if it is in `draft` status.
* An invoice can only be marked as `sent-to-client` if its current status is `sending`.
* To be sent, an invoice must contain product lines with both quantity and unit price as positive integers greater than **zero**.

### Invoice Sending Workflow:

* **Send an email notification** to the customer using the `NotificationFacade`.
    * The email's subject and message may be hardcoded or customized as needed.
    * Change the **Invoice Status** to `sending` after sending the notification.

### Delivery:

* Upon successful delivery by the Dummy notification provider:
    * The **Notification Module** triggers a `ResourceDeliveredEvent` via webhook.
    * The **Invoice Module** listens for and captures this event.
    * The **Invoice Status** is updated from `sending` to `sent-to-client`.
    * **Note**: This transition requires that the invoice is currently in the `sending` status.

## Technical Requirements:

* **Preferred Approach**: Domain-Driven Design (DDD) is preferred for this project. If you have experience with DDD, please feel free to apply this methodology. However, if you are more comfortable with another approach, you may choose an alternative structure.
* **Alternative Submission**: If you have a different, comparable project or task that showcases your skills, you may submit that instead of creating this task.
* **Unit Tests**: Core invoice logic should be unit tested. Testing the returned values from endpoints is not required.
* **Documentation**: Candidates are encouraged to document their decisions and reasoning in comments or a README file, explaining why specific implementations or structures were chosen.

## Setup Instructions:

* Start the project by running `./start.sh`.
* To access the container environment, use: `docker compose exec app bash`.
