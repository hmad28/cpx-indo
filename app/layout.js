import { Bebas_Neue, Plus_Jakarta_Sans } from 'next/font/google';
import './globals.css';

const display = Bebas_Neue({ weight: '400', subsets: ['latin'], variable: '--font-display' });
const body = Plus_Jakarta_Sans({ subsets: ['latin'], variable: '--font-body' });

export const metadata = {
    title: 'CPX Official — Custom Jersey Studio',
    description: 'Produksi jersey custom dan sportswear untuk tim, komunitas, dan brand.',
    icons: { icon: '/images/logo cpx.ico' },
};

export default function RootLayout({ children }) {
    return (
        <html lang="id" className={`${display.variable} ${body.variable}`}>
            <body>{children}</body>
        </html>
    );
}
