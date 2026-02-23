import type { Metadata } from 'next';
import '@/styles/globals.css';

export const metadata: Metadata = {
  title: 'WebGL Lab — Experimental Creative Development',
  description: 'An immersive WebGL experience featuring fluid simulation, shader distortion, and cinematic transitions.',
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="fr">
      <body>{children}</body>
    </html>
  );
}
