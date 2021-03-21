=========== 
# DB Architecture :rocket
## Product table
[]
- _id_
- 'name'
- 'price'
- 'units'
- 'description'
- 'image'
- 'minimum orders'
- 'maximum orders'
> link by id to GroupBuy table
> link by id to Watching table
> link by id to Token table

## Watchlist table
[]
## Token table
[]
## GroupBuy table
[]
> Created when someone starts a groupbuy of a product
- _id_
- 'date start'
- 'date end'
- 'required orders'
- 'current orders'
- 'started by'
- 'success date'

## Order table
[]
- _id_
- 'order by user id'
- 'order product id'
- 'order groupbuy id'
- 'order status' : 'in groupbuy', 'groupbuy failed', 'processing', 'shipping', 'fulfilled'
- 'order date'
- 'order fulfilled date'

## User Payment table
[]
- _id_
- 'payment order id'
- 'payment date'
- 'payment status'
- 'payment amount'
- 'payment commission' : (5% of 'payment amount')
- 'payment merchant payout' : ('payment amount' - 'payment commission')
- 'payment gateway' : 'stripe'
- []

## Merchant Payment table
[]
> created when groupbuy is successful, all user payments' _'payment merchant payout'_ is __summed__ into 1 record in this table. 
- _id_
- 

===========
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
