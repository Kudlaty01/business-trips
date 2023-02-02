# Business trips Allowance simple calculator API

#### Usage

* Setup docker and docker-compose on your environment
    * https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-18-04 (or https://docs.docker.com/install/linux/docker-ce/ubuntu/#install-docker-ce)
    * https://docs.docker.com/compose/install/
* You will need the following ports open:
    * 12090 (nginx)
* Run
    * `make up` - if docker settings have not changed from the last build or you want to run application for the first time

      App is visible on http://localhost:12090

    * `make recreate` - if docker settings have changed from the last build
    * `make clear` - if you want clear cache
    * `make appl` - if you want get application logs
    * `make attach` - if you want to connect to php container
    * `make composer install` - if you want to install php libraries
* Run
    * `docker-compose logs -f` - to check for errors
* Wait for the containers to finish building
* Verify that all containers are up and running:
    * `make ps`

* Calculate
  * To calculate the allowance for a business trip a `POST` request has to be performed to the `{domain}/api/business_trip` endpoint with country and both start and end dates. This will create a BusinessTrip entry and will return the `allowance` field after successful entity creation, e.g.: the following request
```json
{
  "country": "PL",
  "startDate": "2023-02-06T12:54:13.315Z",
  "endDate": "2023-02-16T12:10:13.315Z"
}
```
can respond with
```json
{
  "@context": "/api/contexts/BusinessTrip",
  "@id": "/api/business_trips/5",
  "@type": "BusinessTrip",
  "id": 5,
  "country": "PL",
  "startDate": "2023-02-06T12:54:13+00:00",
  "endDate": "2023-02-16T12:10:13+00:00",
  "allowance": 130
}
```
  * Additionally, it's also possible to list all the registered business trips, show details per entity id and even remove some entries made by mistake
  * Whole api documentation is visible at `{domain}/api/` endpoint where also test requests can be performed