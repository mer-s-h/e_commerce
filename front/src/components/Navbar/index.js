import React from "react";
import {
    Nav,
    NavLogo,
    NavLink,
    Bars,
    NavMenu,
} from "./NavbarElements";
import 'bootstrap/dist/css/bootstrap.min.css';
import { useCookies } from "react-cookie";

const Navbar = ({ countCartItems }) => {
    const [cookies, setCookie, removeCookie] = useCookies(['user']);

    function handleLogout() {
        removeCookie("user")
        removeCookie("userId")
    }
    return (
        <>
            <Nav>
                <NavLogo to="/" className="logo-title">
                    Planteco
                </NavLogo>
                <Bars />
                <NavMenu>
                    <NavLink to="/shopping" className="navlink">
                        Shopping
                    </NavLink>
                    <NavLink to="/about" className="navlink">
                        About
                    </NavLink>
                    <NavLink to="/blog" className="navlink">
                        Blog
                    </NavLink>
                    { cookies.admin ?
                        <NavLink to="/admin" className="navlink">
                            New product
                        </NavLink>
                        :
                        ""
                    }
                    {cookies.user ? (
                        <>

                            <NavLink to="/" className="navlink">
                                <form className="formButtonHome" onClick={handleLogout}>
                                    <i className="fas fa-sign-out-alt"></i>
                                </form>
                            </NavLink>
                        </>
                    ) : (
                        <>
                            <NavLink to="/signIn" className="navlink">
                                Sign In
                            </NavLink>
                            <NavLink to="/logIn" className="navlink">
                                Log In
                            </NavLink>
                        </>
                    )}
                </NavMenu>
                <NavMenu>
                    {cookies.user ? (
                        <NavLink to="/profil" className="navlink">
                            <i className="fas fa-user-alt"></i>
                        </NavLink>
                    ) : ("")}

                    <NavLink to="/cart" className="navlink">
                        <i className="fas fa-shopping-cart"></i>
                        {countCartItems ?? (
                            {countCartItems}
                            )}
                    </NavLink>
                </NavMenu>
            </Nav>
        </>
    );
};
export default Navbar;