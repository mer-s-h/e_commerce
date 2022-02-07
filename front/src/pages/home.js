import React, { useState, useEffect } from 'react'
import Banner from '../images/banner2.png'
import Ban from '../images/ban1.jpg'
import { Carousel } from 'react-bootstrap';
// import { useCookies } from 'react-cookie';
import { Link } from 'react-router-dom';
// import Products from '../components/Products/Products';
// import Product from '../components/Products/Product';
import ProductHome from '../components/Products/ProductHome'




function Home({products}) {
  

    return (
        <div>

            {/* Carousel Section */}

            <div>
                <Carousel fade>
                    <Carousel.Item>
                        <img
                            className="d-block w-100"
                            src={Banner}
                            alt="First slide"
                        />
                        {/* <Carousel.Caption>
                            <h3>First slide label</h3>
                            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                        </Carousel.Caption> */}
                    </Carousel.Item>
                    <Carousel.Item>
                        <img
                            className="d-block w-100"
                            src={Ban}
                            alt="Second slide"
                        />
                        {/* <Carousel.Caption>
                    <h3>Second slide label</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </Carousel.Caption> */}
                    </Carousel.Item>
                </Carousel>
            </div>

            {/* Huiles section */}

            <div>
                <div style={{ padding: '3rem' }}>
                    <h1 style={{ marginBottom: '3rem', textAlign: 'center', fontFamily: 'Kalam' }}>Huiles essentielles</h1>
                    <div style={{display: 'flex'}}>
                    
                        <ProductHome products={products}/>
                    
                    </div>
                </div>

            </div>
            
        </div>

    )
}

export default Home