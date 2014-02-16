<?php

require_once '../Auth42.php';

/**
 * A simple ldap auth test.
 * @author sanecz <lbekdach@student.42.fr>
 */

$user_login = "";
$user_password = "";

$ldaprdn = 'uid=' . $user_login . ',ou=2013,ou=people,dc=42,dc=fr'; // couple user_login user_password que tu as recup de quelconque maniere..
$ldappass = $user_password;

$ldapconn = ldap_connect ("ldaps://ldap.42.fr") or die ("Could not connect to LDAP server.");
ldap_set_option ($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

if ( $ldapconn )
{
    $ldapbind = @ldap_bind ($ldapconn, $ldaprdn, $ldappass);
    if ( $ldapbind )
        echo "LDAP bind successful...\n"; // Si tu peux bind, c'est que le couple pass/login est correct, sinon, non..
    else
        echo "LDAP bind failed...\n";
}
ldap_close ($ldapconn);

/* Trying with Auth42 wrapper */
$result = Auth42::authenticate ($user_login, $user_password);
    if ( $result )
        echo "authenticate bind successful...\n"; // Si tu peux bind, c'est que le couple pass/login est correct, sinon, non..
    else
        echo "authenticate bind failed...\n";

?>
