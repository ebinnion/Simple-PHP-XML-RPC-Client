# Simple PHP XML-RPC Client

I don't use XML-RPC often, and when I do, it's usually for testing a single method. In those cases, I wanted something simple and fast to test with.

After looking, I saw a couple of tools, but most of them seemed more complex than what I really needed/wanted. So, I built this little client to help me with testing XML-RPC calls.

If you find it useful, that's great. Otherwise, I'm happy knowing that it'll make testing a bit easier in the future. :p

Cheers,
Eric Binnion

### Usage

Here's an example of how you would use the client to query the `wp.getPosts` method of a WordPress site:

```php
$xml_rpc = new Simple_XMLRPC_Client( 'https://eric.blog/xmlrpc.php' );
print_r( $xml_rpc->call( 'wp.getPosts', array(
    $blog_id,
    $username,
    $password,
) ) );
```

For other WordPress XML-RPC methods, see the documentation here:

[https://codex.wordpress.org/XML-RPC_WordPress_API](https://codex.wordpress.org/XML-RPC_WordPress_API)
