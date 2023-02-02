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