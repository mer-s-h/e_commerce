import React, { useState, useEffect } from "react";
import 'bootstrap/dist/css/bootstrap.min.css';
import Navbar from "./components/Navbar";
import Footer from './components/Footer/Footer';
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Home from './pages/home';
import SignIn from './pages/signIn'
import LogIn from './pages/login'
import Cart from "./pages/cart"
import Profil from "./pages/profil";
import { useCookies } from "react-cookie";
import Shopping from "./pages/shopping";
import Admin from "./pages/admin";
import ForgotPassword from "./pages/forgotPassword";
import ProductDetail from "./components/Products/ProductDetail";

function App() {
  const [cookies, setCookie, removeCookie] = useCookies(['user']);
  const [cartItems, setCartItems] = useState([]);
  const [data, setData] = useState([])

  useEffect(() => {
    fetch(`${process.env.REACT_APP_API_URL}/product/read/all`, {
      method: 'POST',
    })
      .then((res) => res.json())
      .then((res) => {
        setData(res.product)
      })
      .catch((err) => console.log(err));
  }, [])

  const onAdd = (product) => {
    const exist = cartItems.find(x => x.id === product.id)
    if (exist) {
      setCartItems(cartItems.map(x => x.id === product.id ? { ...exist, qty: exist.qty + 1 } : x))
    } else {
      setCartItems([...cartItems, { ...product, qty: 1 }])
    }
  }

  const onRemove = (product) => {
    const exist = cartItems.find(x => x.id === product.id);
    if (exist.qty === 1) {
      setCartItems(cartItems.filter((x) => x.id !== product.id));
    } else {
      setCartItems(
        cartItems.map((x) =>
          x.id === product.id ? { ...exist, qty: exist.qty - 1 } : x
        )
      );
    }
  }

  var countCartItems = 0;
  cartItems.forEach(element => {
    countCartItems += element.qty
  });

  return (
    <Router>
      <Navbar countCartItems={countCartItems} />
      <Routes>
        <Route path="/" exact element={<Home products={data} /> } />
        <Route path="/signin" exact element={<SignIn />} />
        <Route path="/shopping" exact element={<Shopping products={data} onAdd={onAdd} />} />
        <Route path="/login" exact element={<LogIn />} />
        <Route path="/cart" exact element={<Cart cartItems={cartItems} products={data} onAdd={onAdd} onRemove={onRemove} />} />
        <Route path="/profil" exact element={<Profil />} />
        <Route path="/admin" exact element={<Admin />} />
        <Route path="/shopping/:id" element={<ProductDetail onAdd={onAdd} />}/>
        <Route path="/forgotPassword" element={<ForgotPassword />}/>
      </Routes>
      <Footer />
    </Router>
  );
}

export default App;
