<?php

When we make websites with PHP, the PHP part is always the server. When
using APIs, we build the server in PHP, but we can consume APIs from PHP as well.

This is the point where things can get confusing. We can create either a client or a server
in PHP, and requests and responses can be either incoming or outgoing—or both!

When we build a server, we follow patterns similar to the way that we build web pages.
A request arrives, and we use PHP to figure out what was requested and craft the correct
response. For example, if we built an API for customers so they could get updates on
their orders programmatically, we would be building a server.

Using PHP to consume APIs means we are building a client. Our PHP application makes
requests to external services over HTTP, and then uses the responses for its own purposes.



?>