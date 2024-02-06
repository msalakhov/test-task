# test-task

task -- https://github.com/systemeio/test-for-candidates

build
```
docker compose up -d
make refresh
```

send requests
```
curl -X 'POST' \
  'http://localhost/calculate-price' \
  -H 'accept: application/json' \
  -H 'Content-Type: application/json' \
  -d '{
  "product": 1,
  "taxNumber": "IT12345678900",
  "couponCode": "S42"
}'

curl -X 'POST' \
  'http://localhost/purchase' \
  -H 'accept: application/json' \
  -H 'Content-Type: application/json' \
  -d '{
  "paymentProcessor": "paypal",
  "product": 1,
  "taxNumber": "IT12345678900",
  "couponCode": "S42"
}'
```
or use visual doc interfase http://loclahost
