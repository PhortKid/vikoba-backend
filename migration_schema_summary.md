# Database Schema Summary for Vikoba Backend Migrations

This document summarizes the current database schema for the Vikoba backend application, excluding the following framework tables:
- `users`
- `cache`
- `jobs`
- `personal_access_tokens`

## customers
- `id` (primary key, auto-increment)
- `first_name` (string, nullable)
- `middle_name` (string, nullable)
- `last_name` (string, nullable)
- `national_id` (string, nullable, unique)
- `address` (string, nullable)
- `gender` (enum: `male`, `female`, `other`, default `other`)
- `mobile` (string, nullable)
- `email` (string, nullable)
- `employment_type` (enum: `government`, `private`, `student`, `business`, default `business`)
- `salary` (decimal 15,2, nullable)
- `created_at` (timestamp)
- `updated_at` (timestamp)

Notes:
- The migration includes a comment that salary can be nullable for entrepreneurs or students.

## guarantors
- `id` (primary key, auto-increment)
- `first_name` (string)
- `middle_name` (string, nullable)
- `last_name` (string)
- `mobile` (string)
- `email` (string, nullable)
- `address` (string, nullable)
- `national_id` (string, nullable, unique)
- `employment_type` (enum: `government`, `private`, `student`, `business`, default `business`)
- `created_at` (timestamp)
- `updated_at` (timestamp)

Notes:
- The migration comments indicate employment_type may be used for guarantor job relationship details.

## loan_types
- `id` (primary key, auto-increment)
- `name` (string)
- `description` (text, nullable)
- `interest_rate` (decimal 5,2)
- `penalty_rate` (decimal 5,2)
- `created_at` (timestamp)
- `updated_at` (timestamp)

Notes:
- Comments explain the interest and penalty rates are core settings for each loan type and that decimal(5,2) allows values such as `20.00` or `10.50`.

## loans
- `id` (primary key, auto-increment)
- `customer_id` (foreign key to `customers`, cascade delete)
- `user_id` (foreign key to `users`) - comment: `Afisa aliyepitisha mkopo`
- `loan_type_id` (foreign key to `loan_types`)
- `principal_amount` (decimal 15,2)
- `interest_rate` (decimal 5,2)
- `penalty_rate` (decimal 5,2)
- `processing_fee` (decimal 15,2, default 0) - comment: `Ada ya mkopo`
- `form_fee` (decimal 15,2, default 0) - comment: `Hela ya fomu`
- `total_amount` (decimal 15,2) - comment: `Principal + Total Interest`
- `net_disbursed_amount` (decimal 15,2) - comment: `Principal - Fees`
- `repayment_frequency` (enum: `daily`, `weekly`, `monthly`)
- `duration_days` (integer) - comment: `badala ya ku rely on days pekee`
- `number_of_installments` (integer)
- `start_date` (date, nullable)
- `end_date` (date, nullable)
- `approved_by` (foreign key to `users`, nullable) - comment: `Afisa aliyepitisha mkopo`
- `approved_at` (timestamp, nullable) - comment: `Tarehe ya kuidhin`
- `status` (string, nullable)
- `created_at` (timestamp)
- `updated_at` (timestamp)

Notes:
- The migration adds approval metadata.
- `status` is stored as a nullable string rather than a strict enum.

## loan_guarantor
- `id` (primary key, auto-increment)
- `loan_id` (foreign key to `loans`, cascade delete)
- `guarantor_id` (foreign key to `guarantors`, cascade delete)
- `relationship` (string) - comment: `rafiki, ndugu, mfanyakazi mwenzake`
- `guarantee_amount` (decimal 15,2, nullable) - comment: `Kiasi anachodhamini`
- `status` (enum: `active`, `released`, default `active`) - comment: `Hali ya udhamini`
- `created_at` (timestamp)
- `updated_at` (timestamp)

Notes:
- The migration comments describe guarantor-specific sponsorship details.

## loan_schedules
- `id` (primary key, auto-increment)
- `loan_id` (foreign key to `loans`, cascade delete)
- `installment_number` (integer)
- `due_date` (date)
- `principal_due` (decimal 15,2)
- `interest_due` (decimal 15,2)
- `amount_due` (decimal 15,2) - comment: `unaweza kuiacha kama computed/cached`
- `total_penalty` (decimal 15,2, default 0) - comment: `penalties (aggregated)`
- `principal_paid` (decimal 15,2, default 0)
- `interest_paid` (decimal 15,2, default 0)
- `penalty_paid` (decimal 15,2, default 0)
- `status` (enum: `pending`, `paid`, `overdue`, `partially_paid`, default `pending`)
- `created_at` (timestamp)
- `updated_at` (timestamp)

Notes:
- Comments indicate `amount_due` may be optional if it is a computed or cached field.
- Payment tracking is split across principal, interest, and penalty.

## payments
- `id` (primary key, auto-increment)
- `loan_id` (foreign key to `loans`, cascade delete)
- `schedule_id` (foreign key to `loan_schedules`, nullable, set null on delete)
- `principal_paid` (decimal 15,2)
- `interest_paid` (decimal 15,2, default 0)
- `penalty_paid` (decimal 15,2, default 0)
- `total_paid` (decimal 15,2) - comment: `optional (for quick total)`
- `payment_method` (enum: `cash`, `mobile_money`, `bank`, default `cash`)
- `reference_no` (string, nullable, unique)
- `received_by` (foreign key to `users`) - comment: `Afisa aliyepokea malipo`
- `created_at` (timestamp)
- `updated_at` (timestamp)

Notes:
- This table tracks actual payments and supports both schedule-based and ad hoc loan payments.

## penalties
- `id` (primary key, auto-increment)
- `loan_id` (foreign key to `loans`, cascade delete)
- `schedule_id` (foreign key to `loan_schedules`, cascade delete)
- `amount` (decimal 15,2)
- `reason` (string, default `Late payment penalty`)
- `penalty_date` (date)
- `created_at` (timestamp)
- `updated_at` (timestamp)

Notes:
- Penalties are recorded per loan schedule and include a default reason for late payment.
