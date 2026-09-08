# Documentation references

https://pennylane.readme.io/docs/getting-started

https://pennylane.readme.io/docs/generating-my-api-token

https://pennylane.readme.io/docs/v2-scopes

https://pennylane.readme.io/docs/create-a-customer-invoice-use-case


## Process overview

Show products & prices

* https://app.pennylane.com/api/external/v2/products


Sales process

* Check authorisation https://app.pennylane.com/api/external/v2/me
* Check customer exists https://app.pennylane.com/api/external/v2/customers
* (optional) Create customer: https://app.pennylane.com/api/external/v2/company_customers
* Retrieve products https://app.pennylane.com/api/external/v2/products
* Create invoice https://app.pennylane.com/api/external/v2/customer_invoices
* Send invoice https://app.pennylane.com/api/external/v2/customer_invoices/9876/send_by_email


Reconciliation process

* https://app.pennylane.com/api/external/v2/customer_invoices/9876/matched_transactions

