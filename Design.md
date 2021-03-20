
### Product table
--id
, 'name'
, 'price'
, 'units'
, 'description'
, 'image'
, 'minimum orders'
, 'maximum orders'

- link by id to GroupBuy table
- link by id to Watching table
- link by id to Token table

### GroupBuy table
_Created when someone starts a groupbuy of a product_

--id
, 'date start'
, 'date end'
, 'required orders'
, 'current orders'
, 'started by'
, 'success date'

*Page* Home screen
|
|
|
|

*Page* Product Management 
- Create
- Retrieve
- Update
- Delete
-> Show up in Home Page and Catelog

====
# Modules
## User
_Product Management_
- retrieve
  - Catagories
  - Sorting
    - Watchlist (popularity)
    - Watchlist + Token (extra pop)
- update
  - +/- 1 watchlist (in watchlist table)
  - +/- 1 groupbuy (in groupbuy table)


_Order Management_
- email notification (SMTP)
  - etc.
- order processing
  - shipping status
  - receive status
  - product rating

_Payment History_
- payment (Stripe payment gatement)
  - payment status
  - refund status
- order history

_Account Mangement_
- create (signup)
- update
- delete

## Merchant
_Product Management_ **subject to admin's reviews**
- create
- retrieve
- update
- delete


_Order Management_
- email notification
  - when there are interest
  - when there are groupbuy started
  - when there are successful groupbuy
  - when there are unsucessful groupbuy
  - etc.
- order processing
  - ship
  - receive
  - rating

_Payment Management_
- receive payment (from G-Buy)
- payment history
  - sort
  - filter
  - etc

_Account Mangement_
- view
- update


## Admin
_Product Management_
- create
  - auto-approved
- retrieve
- update
  - approval
  - edit
- delete
- rating

_Order Management_
- 'user email notification' database
- 'order status' database
  - ship
  - receive

_Payment Management_
- user payment
  - receive payment
  - hold payment
  - refund payment
- merchant payment
  - process (release to merchant (take 10%))

_Account Mangement_
- ACL (admin / user / merchant)
  - create
  - retrieve
  - update
  - delete
