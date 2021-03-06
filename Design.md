=========== 
# DB Architecture :rocket
### Product table
- [ ] done
- _id_
- 'name'
- 'price'
- ~~'units'~~
- 'description'
- 'image'
- 'minimum orders'
- 'maximum orders'

### Watchlist table
- [ ] done
> link by id to Product table
### Token table
- [ ] done
> link by id to Product table
### GroupBuy table
- [ ] done
> Created when someone starts a groupbuy of a product
> link by id to Product table
- _id_
- 'product_id'
- 'status'
- 'date_start'
- 'date_end'
- 'min_required'
- 'max_available'
- 'current_orders'
- 'started_by'
- 'success_date'

### Order table
- [ ] done
- _id_
- 'order by user id'
- 'order product id'
- 'order groupbuy id'
- 'order status' : 'in groupbuy', 'groupbuy failed', 'processing', 'shipping', 'fulfilled'
- 'order date'
- 'order fulfilled date'

### User Payment table
- [ ] done
- _id_
- 'payment order id'
- 'payment date'
- 'payment status'
- 'payment amount'
- 'payment commission' : (5% of 'payment amount')
- 'payment merchant payout' : ('payment amount' - 'payment commission')
- 'payment gateway' : 'stripe'

### Merchant Payment table
- [ ] done
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
